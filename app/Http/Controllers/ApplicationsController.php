<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Mail\ApplicationSubmitted;
use App\Models\Application;
use App\Models\{JobListing, User};
use Carbon\Carbon;
use ZipArchive;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Mail\ShortlistedNotification;

class ApplicationsController extends Controller
{
    protected $qualificationRanks = [
        'Certificate' => 1,
        'Diploma'     => 2,
        'Degree'      => 3,
        'Master'      => 4,
        'PhD'         => 5,
    ];

    /**
     * Filter applications by minimum qualification, experience, completeness.
     */
    public function filter(Request $request)
    {
        $minQualification = ucfirst(strtolower(trim($request->input('min_qualification', 'Any'))));
        $minExperienceYears = (int) $request->input('min_experience_years', 0);
        $minCompleteness = (int) $request->input('min_completeness', 0);

        $minQualificationRank = $this->qualificationRanks[$minQualification] ?? 0;

      $applications = Application::with([
    'jobListing',
    'user.academicRecords',
    'user.employmentHistory',
    'user.professionalQualifications',
    'user.professionalMemberships',
    'user.referees',
])->get();

// Filter out null job listings or users
$applications = $applications->filter(function ($application) {
    return $application->jobListing !== null && $application->user !== null;
});

// Now apply your detailed filters
$filtered = $applications->filter(function ($application) use (
    $minQualification,
    $minQualificationRank,
    $minExperienceYears,
    $minCompleteness
) {
    $user = $application->user;
    if (!$user) return false;

    if ($minQualification !== 'Any') {
        if ($user->academicRecords->isEmpty()) return false;

        $hasQualification = $user->academicRecords->contains(function ($record) use ($minQualificationRank) {
            $qualification = strtolower(trim($record->qualification ?? ''));
            foreach ($this->qualificationRanks as $key => $rank) {
                if (str_contains($qualification, strtolower($key))) {
                    return $rank >= $minQualificationRank;
                }
            }
            return false;
        });

        if (!$hasQualification) return false;
    }

    if ($minExperienceYears > 0) {
        $totalMonths = 0;
        foreach ($user->employmentHistory as $job) {
            try {
                $start = $job->start_date ? Carbon::parse($job->start_date) : null;
                $end = $job->end_date ? Carbon::parse($job->end_date) : Carbon::now();
                if ($start) {
                    $totalMonths += $end->diffInMonths($start);
                }
            } catch (\Exception $e) {
                continue;
            }
        }
        if (($totalMonths / 12) < $minExperienceYears) return false;
    }

    if ($minCompleteness > 0 && method_exists($user, 'profileCompleteness')) {
        if ($user->profileCompleteness() < $minCompleteness) return false;
    }

    return true;
});


        $page = $request->input('page', 1);
        $perPage = 10;

        $paginatedResults = new LengthAwarePaginator(
            $filtered->forPage($page, $perPage)->values(),
            $filtered->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.applications.index', ['applications' => $paginatedResults]);
    }


public function sendShortlistEmails(Request $request)
{
    $applications = collect();

    // If specific application IDs are provided
    if ($request->has('application_ids') && is_array($request->application_ids)) {
        $request->validate([
            'application_ids' => 'required|array',
            'application_ids.*' => 'exists:applications,id',
        ]);

        $applications = Application::whereIn('id', $request->application_ids)
            ->with(['user', 'jobListing'])
            ->get();
    } else {
        // If no specific IDs, send to all with status = shortlisted
        $applications = Application::with(['user', 'jobListing'])
            ->where('status', 'shortlisted')
            ->get();
    }

    $sent = 0;

    foreach ($applications as $application) {
        if ($application->user && $application->user->email) {
            Mail::to($application->user->email)->queue(new \App\Mail\ShortlistedNotification($application));
            $sent++;
        }
    }

    return back()->with('success', "$sent shortlisted email(s) sent successfully.");
}

    /**
     * Show job listings and user's applications.
     */
    public function userApplications()
    {
        $jobListings = JobListing::isPublished()->paginate(10);
        $userApplications = Application::where('user_id', Auth::id())->pluck('job_listing_id')->toArray();

        return view('user.applications', compact('jobListings', 'userApplications'));
    }

    /**
     * Apply for a job.
     */
   public function apply($id)
{
    $user = Auth::user();
    $user->load([
        'academicRecords',
        'professionalQualifications',
        'professionalMemberships',
        'employmentHistory',
        'referees'
    ]);

    //  Load the job
    $job = JobListing::findOrFail($id);

    //  Check if job is expired
    if ($job->deadline && \Carbon\Carbon::parse($job->deadline)->isPast()) {
        return redirect()->back()->with('error', 'This job has expired. You can no longer apply.');
    }

    //  Check for missing biodata
    $requiredBiodataFields = ['name', 'dob', 'phone', 'email', 'county', 'sub_county'];
    foreach ($requiredBiodataFields as $field) {
        if (empty($user->$field)) {
            return redirect()->back()->with('error', "Please complete your profile: missing {$field}.");
        }
    }

    //  Check for empty sections
    if (
        $user->academicRecords->isEmpty() ||
        $user->professionalQualifications->isEmpty() ||
        $user->professionalMemberships->isEmpty() ||
        $user->employmentHistory->isEmpty() ||
        $user->referees->isEmpty()
    ) {
        return redirect()->back()->with('error', 'Please complete all sections of your profile before applying.');
    }

    //  Check profile completeness
    if (!$user->isProfileComplete()) {
        return redirect()->back()->with('error', 'Please complete your profile before applying.');
    }

    //  Check if already applied
    if (Application::where('user_id', $user->id)->where('job_listing_id', $id)->exists()) {
        return redirect()->back()->with('error', 'You have already applied for this job.');
    }

    //  Create application
    $application = Application::create([
        'job_listing_id' => $id,
        'user_id'        => $user->id,
        'status'         => 'Processing',
    ]);

    //  Send confirmation email
    Mail::to($user->email)->queue(new ApplicationSubmitted($user, $application));

    return redirect()->route('user.applications')->with('success', 'Application submitted successfully.');
}

    /**
     * Admin: View an application in detail.
     */
    public function show($id)
    {
        $application = Application::with([
            'user.academicRecords',
            'user.employmentHistory',
            'user.professionalMemberships',
            'user.professionalQualifications',
            'user.referees',
            'jobListing',
            'updatedBy',
        ])->findOrFail($id);

        return view('admin.applications.show', compact('application'));
    }

    /**
     * Admin: Update application status.
     */
 public function update(Request $request, $id)
{
    $request->validate(['status' => 'required|string']);

    $application = Application::with('user', 'jobListing')->findOrFail($id);
    $oldStatus = $application->status;
    $newStatus = $request->input('status');

    $application->update(['status' => $newStatus]);

    if (
        strtolower($newStatus) === 'shortlisted' &&
        strtolower($oldStatus) !== 'shortlisted' &&
        $application->user &&
        $application->user->email
    ) {
        Log::info('Sending shortlisted email to: ' . $application->user->email);

        try {
            Mail::to($application->user->email)->send(new ShortlistedNotification($application));
            Log::info('Shortlisted email successfully sent.');
        } catch (\Exception $e) {
            Log::error('Failed to send shortlisted email: ' . $e->getMessage());
        }
    }

    return redirect()->back()->with('success', 'Application status updated.');
}

    /**
     * Show a user's application detail.
     */
    public function showApplication($id)
    {
        $application = Application::with('jobListing')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('user.application_detail', compact('application'));
    }

    /**
     * View uploaded document.
     */
    public function viewDocument($id)
    {
        $application = Application::findOrFail($id);

        if ($application->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access.');
        }

        if (!$application->document_filename) {
            abort(404, 'No document uploaded.');
        }

        $filePath = storage_path('app/public/documents/' . $application->document_filename);
        if (!file_exists($filePath)) {
            abort(404, 'Document not found.');
        }

        return response()->file($filePath);
    }

    /**
     * Upload application document.
     */
    public function uploadDocument(Request $request)
    {
        $request->validate([
            'document' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'application_id' => 'required|exists:applications,id',
        ]);

        $application = Application::findOrFail($request->application_id);

        if ($application->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $filename = time() . '_' . $request->file('document')->getClientOriginalName();
        $request->file('document')->storeAs('documents', $filename, 'public');

        $application->update(['document_filename' => $filename]);

        return back()->with('success', 'Document uploaded successfully.');
    }


   

    /**
     * Export applicants for a job to CSV.
     */
    public function exportApplicants($job_id)
{
    $applications = Application::where('job_listing_id', $job_id)
        ->with(['user']) // Removed the unnecessary related data
        ->get();

    $fileName = 'applicants_job_' . $job_id . '_' . now()->format('Ymd_His') . '.csv';

    $headers = [
        'Content-Type'        => 'text/csv',
        'Content-Disposition' => "attachment; filename=\"$fileName\"",
    ];

    $columns = [
        'Name', 'Email', 'Phone', 'County', 'Sub County', 'Ethnicity', 'DOB', 'Gender',
        'Nationality', 'ID/Passport', 'KRA Pin', 'Profile Completeness'
    ];

    $callback = function () use ($applications, $columns) {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach ($applications as $app) {
            $user = $app->user;
            if (!$user) continue;

            $completeness = method_exists($user, 'profileCompleteness') ? $user->profileCompleteness() . '%' : 'N/A';

            fputcsv($file, [
                $user->name ?? '', $user->email ?? '', $user->phone ?? '',
                $user->county ?? '', $user->sub_county ?? '', $user->ethnicity ?? '',
                $user->dob ? \Carbon\Carbon::parse($user->dob)->format('Y-m-d') : '', $user->gender ?? '',
                $user->nationality ?? '', $user->id_passport ?? '', $user->kra_pin ?? '',
                $completeness
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

public function report()
{
    // Example Data
    $applicationsPerJob = Application::select('job_listing_id', DB::raw('count(*) as total'))
        ->groupBy('job_listing_id')
        ->with('jobListing')
        ->get();

    $genderDistribution = User::select('gender', DB::raw('count(*) as total'))
        ->groupBy('gender')
        ->get();

    // Pass data to view
    return view('admin.applications.report', compact('applicationsPerJob', 'genderDistribution'));
}

    /**
     * Admin: Application analytics dashboard.
     */
    public function analytics()
    {
        // Total applications count
        $totalApplications = Application::count();
        
        // Total unique applicants
        $totalApplicants = Application::distinct('user_id')->count();
        
        // Total job listings
        $totalJobs = JobListing::count();
        
        // Published job listings
        $publishedJobs = JobListing::where('is_published', 1)->count();

        // Applications per job with more details
        $applicationsPerJob = JobListing::withCount('applications')
            ->with('applications')
            ->orderBy('applications_count', 'desc')
            ->get();

        // Gender distribution
        $genderDistribution = User::select('gender', DB::raw('count(*) as total'))
            ->join('applications', 'users.id', '=', 'applications.user_id')
            ->groupBy('gender')
            ->orderBy('total', 'desc')
            ->get();

        // Regional distribution (based on county)
        $regionalDistribution = User::select('county', DB::raw('count(*) as total'))
            ->join('applications', 'users.id', '=', 'applications.user_id')
            ->groupBy('county')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        // Application status distribution
        $statusDistribution = Application::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->orderBy('total', 'desc')
            ->get();

        // Application trends over time (last 30 days)
        $applicationTrends = Application::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Recent applications (last 10)
        $recentApplications = Application::with(['user', 'jobListing'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Top performing jobs (most applications)
        $topJobs = JobListing::withCount('applications')
            ->orderBy('applications_count', 'desc')
            ->limit(5)
            ->get();

        // Average applications per job
        $avgApplicationsPerJob = $totalJobs > 0 ? round($totalApplications / $totalJobs, 1) : 0;

        // Applications this week
        $applicationsThisWeek = Application::where('created_at', '>=', now()->startOfWeek())->count();

        // Applications this month
        $applicationsThisMonth = Application::where('created_at', '>=', now()->startOfMonth())->count();

        return view('admin.applications.analytics', compact(
            'totalApplications',
            'totalApplicants',
            'totalJobs',
            'publishedJobs',
            'applicationsPerJob',
            'genderDistribution',
            'regionalDistribution',
            'statusDistribution',
            'applicationTrends',
            'recentApplications',
            'topJobs',
            'avgApplicationsPerJob',
            'applicationsThisWeek',
            'applicationsThisMonth'
        ));
    }

    /**
     * Download ZIP of applicant documents.
     */
    public function downloadAllDocuments($job_id)
    {
        $applications = Application::with('user')
            ->where('job_listing_id', $job_id)
            ->get();

        $zipFileName = 'applicants_documents_job_' . $job_id . '_' . now()->format('Ymd_His') . '.zip';
        $zipPath = storage_path('app/temp/' . $zipFileName);

        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }

        $zip = new ZipArchive;
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            foreach ($applications as $application) {
                $user = $application->user;
                if (!$user || !$application->document_filename) continue;

                $filePath = storage_path('app/public/documents/' . $application->document_filename);
                if (file_exists($filePath)) {
                    $safeName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $user->name ?? 'applicant');
                    $zip->addFile($filePath, "{$safeName}_{$application->id}_" . $application->document_filename);
                }
            }

            $zip->close();
            return response()->download($zipPath)->deleteFileAfterSend(true);
        }

        return redirect()->back()->with('error', 'Could not create ZIP file.');
    }
}

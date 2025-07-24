<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\JobListing;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Job;

class ApplicationController extends Controller
{
    // Admin should be able to see all applications
    public function index(Request $request)
    {
        // Get all applications by job listing ID
        $applications = Application::when($request->job_id, function ($query, $job_id) {
            return $query->where('job_listing_id', $job_id);
        })->get();

        return view('admin.applications.index', compact('applications'));
    }

    // Admin should be able to see a specific application
    public function show($id)
    {
        $application = Application::find($id);
        return view('admin.applications.show', compact('application'));
    }

    // Admin should be able to update the status of an application
    public function update(Request $request, $id)
    {
        $application = Application::find($id);
        $application->status = $request->status;
        $application->save();

        return redirect()->route('admin.applications.index');
    }

    // Analytics Dashboard
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
}

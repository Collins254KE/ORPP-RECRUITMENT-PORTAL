<?php
use App\Models\Application;
use App\Models\JobListing;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\JobListing;

public function dashboard()
{
    // 1. Applications per Job
    $applicationsPerJob = JobListing::withCount('applications')
        ->orderByDesc('applications_count')
        ->get(['id', 'title', 'deadline']);

    // 2. Gender Distribution
    $genderDistribution = User::select('gender', DB::raw('count(*) as total'))
        ->groupBy('gender')
        ->get();

    // 3. Regional Distribution (by county)
    $regionalDistribution = User::select('county', DB::raw('count(*) as total'))
        ->groupBy('county')
        ->orderByDesc('total')
        ->get();

    // 4. Application Trends (last 30 days)
    $applicationTrends = Application::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as total')
        )
        ->where('created_at', '>=', Carbon::now()->subDays(30))
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    return view('admin.dashboard', [
        'applicationsPerJob' => $applicationsPerJob,
        'genderDistribution' => $genderDistribution,
        'regionalDistribution' => $regionalDistribution,
        'applicationTrends' => $applicationTrends,
    ]);
}


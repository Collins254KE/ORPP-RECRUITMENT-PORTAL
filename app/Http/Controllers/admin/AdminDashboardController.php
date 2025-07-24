<?php

namespace App\Http\Controllers\Admin;
use App\Models\JobListing;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Applications per Job
        $applicationsPerJob = JobListing::withCount('applications')->get();


        // Gender Distribution
        $genderDistribution = Application::join('users', 'applications.user_id', '=', 'users.id')
            ->select('users.gender', DB::raw('count(*) as total'))
            ->groupBy('users.gender')
            ->get();

        // Regional Distribution (by County)
        $regionalDistribution = Application::join('users', 'applications.user_id', '=', 'users.id')
            ->select('users.county', DB::raw('count(*) as total'))
            ->groupBy('users.county')
            ->get();

        // Application Trends (last 30 days)
        $applicationTrends = Application::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Age Group Distribution
        $ageGroupDistribution = Application::join('users', 'applications.user_id', '=', 'users.id')
            ->selectRaw("
                CASE
                    WHEN TIMESTAMPDIFF(YEAR, users.dob, CURDATE()) BETWEEN 18 AND 24 THEN '18-24'
                    WHEN TIMESTAMPDIFF(YEAR, users.dob, CURDATE()) BETWEEN 25 AND 34 THEN '25-34'
                    WHEN TIMESTAMPDIFF(YEAR, users.dob, CURDATE()) BETWEEN 35 AND 44 THEN '35-44'
                    WHEN TIMESTAMPDIFF(YEAR, users.dob, CURDATE()) BETWEEN 45 AND 54 THEN '45-54'
                    WHEN TIMESTAMPDIFF(YEAR, users.dob, CURDATE()) >= 55 THEN '55+'
                    ELSE 'Unknown'
                END as age_group, count(*) as total
            ")
            ->groupBy('age_group')
            ->get();

        return view('admin.dashboard', compact(
            'applicationsPerJob',
            'genderDistribution',
            'regionalDistribution',
            'applicationTrends',
            'ageGroupDistribution'
        ));
    } // ← THIS was missing
}

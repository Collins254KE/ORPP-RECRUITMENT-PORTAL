<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicJobController extends Controller
{
    namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;

class PublicJobController extends Controller
{
    // Show all published jobs to users
    public function index()
    {
        $jobs = JobListing::where('is_published', true)
                          ->whereDate('deadline', '>=', now())
                          ->latest()
                          ->get();

        return view('jobs.index', compact('jobs'));
    }

    // Show a single job to users
    public function show($id)
    {
        $job = JobListing::where('is_published', true)
                         ->whereDate('deadline', '>=', now())
                         ->findOrFail($id);

        return view('jobs.show', compact('job'));
    }
}

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListing;

class JobListingController extends Controller
{
    // Show all job listings
    public function index()
    {
        $jobListings = JobListing::isPublished()->latest()->get();
        return view('admin.job_listings.index', compact('jobListings'));
    }

    // Show single job listing
    public function show($id)
    {
        $job = JobListing::findOrFail($id);
        return view('admin.job_listings.show', ['jobListing' => $job]);

    }

    // Store a new job listing
   public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'code' => 'required|string|max:100',
        'location' => 'required|string|max:255',
        'deadline' => 'required|date',
        'duties_and_responsibilities' => 'required|string',
        'requirements' => 'required|string',
        'min_years_of_experience' => 'nullable|integer|min:0',
        'min_level' => 'nullable|integer|between:1,5',
    ]);

    $job = JobListing::findOrFail($id);
    $job->title = $request->title;
    $job->code = $request->code;
    $job->location = $request->location;
    $job->deadline = $request->deadline;
    $job->duties_and_responsibilities = $request->duties_and_responsibilities;
    $job->requirements = $request->requirements;
    $job->min_years_of_experience = $request->input('min_years_of_experience', 0);
    $job->min_level = $request->input('min_level');

 //  Add this line here to handle publication checkbox
    $job->is_published = $request->has('is_published');

    $job->save();

    return redirect()->route('admin.job-listings.index')->with('success', 'Job listing updated successfully.');
}

}

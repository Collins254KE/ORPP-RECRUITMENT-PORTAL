<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobListing;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    // List all job listings
    public function index(Request $request)
    {
        $query = JobListing::query();

        // Filter by minimum level
        if ($request->filled('min_level')) {
            $query->where('min_level', $request->min_level);
        }

        // Filter by minimum years of experience
        if ($request->filled('min_years_of_experience')) {
            $query->where('min_years_of_experience', '>=', $request->min_years_of_experience);
        }

        // Filter by published status
        if ($request->filled('is_published')) {
            $query->where('is_published', $request->is_published);
        }

        $jobListings = $query->get();

        // Get filter values for the view
        $filters = [
            'min_level' => $request->min_level,
            'min_years_of_experience' => $request->min_years_of_experience,
            'is_published' => $request->is_published,
        ];

        return view('admin.job-listings.index', compact('jobListings', 'filters'));
    }

    // Show form to create a new job listing
    public function create()
    {
        return view('admin.job-listings.create');
    }

    // Store a new job listing
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'deadline' => 'required|date',
            'is_published'=>'nullable',
            'posts' => 'nullable|integer|min:1',
            'duties_and_responsibilities' => 'nullable|string',
            'requirements' => 'nullable|string',
            'min_years_of_experience' => 'nullable|integer|min:0|max:50',
            'min_level' => 'nullable|integer|min:1|max:5',
        ]);

        $validatedData['created_by'] = Auth::id();
        $validatedData['code'] = 'JOB-' . strtoupper(uniqid());

        JobListing::create($validatedData);

        return redirect()->route('admin.job-listings.index')
                         ->with('success', 'Job listing created successfully.');
    }

    // Show form to edit an existing job listing
    public function edit($id)
    {
        $jobListing = JobListing::findOrFail($id);
        return view('admin.job-listings.edit', compact('jobListing'));
    }

    // Update an existing job listing
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'posts' => 'nullable|integer|min:1',
            'deadline' => 'required|date',
            'is_published'=>'nullable',
            'duties_and_responsibilities' => 'nullable|string',
            'requirements' => 'nullable|string',
            'min_years_of_experience' => 'nullable|integer|min:0|max:50',
            'min_level' => 'nullable|integer|min:1|max:5',
        ]);

        $jobListing = JobListing::findOrFail($id);
        $jobListing->update($validatedData);

        return redirect()->route('admin.job-listings.index')
                         ->with('success', 'Job listing updated successfully.');
    }

    // Delete a job listing
    public function destroy($id)
    {
        $jobListing = JobListing::findOrFail($id);
        $jobListing->delete();

        return redirect()->route('admin.job-listings.index')
                         ->with('success', 'Job listing deleted successfully.');
    }
}

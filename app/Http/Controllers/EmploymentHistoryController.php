<?php

namespace App\Http\Controllers;

use App\Models\EmploymentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmploymentHistoryController extends Controller
{
    public function create()
    {
        return view('user.employment_history.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'employer_name' => 'required|string|max:255',
            'job_position' => 'required|string|max:255',
            'date_joined' => 'required|date',
            'date_left' => 'nullable|date',
            'roles_responsibilities' => 'required|string|max:250',
        ]);

        // Create the employment history record
        EmploymentHistory::create([
            'employer_name' => $request->employer_name,
            'job_position' => $request->job_position,
            'date_joined' => $request->date_joined,
            'date_left' => $request->date_left,
            'roles_responsibilities' => $request->roles_responsibilities,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('employment_history.index')->with('success', 'Employment history created successfully.');
    }

    public function edit($id)
    {
        $employmentHistory = EmploymentHistory::findOrFail($id); // Retrieve the employment history by ID
        return view('user.employment_history.edit', compact('employmentHistory'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employer_name' => 'required|string|max:255',
            'job_position' => 'required|string|max:255',
            'date_joined' => 'required|date',
            'date_left' => 'nullable|date',
            'roles_responsibilities' => 'required|string|max:250',
        ]);

        // Update the employment history record
        $employmentHistory = EmploymentHistory::findOrFail($id);
        $employmentHistory->update($request->all());

        return redirect()->route('employment_history.index')->with('success', 'Employment history updated successfully.');
    }
    public function index()
    {
        $employmentHistories = EmploymentHistory::where('user_id', Auth::id())->get();
        return view('user.employment_history.index', compact('employmentHistories'));
    }
    public function destroy($id)
{
    $employmentHistory = EmploymentHistory::findOrFail($id);
    $employmentHistory->delete(); // Delete the record

    return redirect()->route('employment_history.index')->with('success', 'Employment history deleted successfully.');
}
}

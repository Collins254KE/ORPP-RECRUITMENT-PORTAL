<?php

namespace App\Http\Controllers;

use App\Models\AcademicRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AcademicRecordController extends Controller
{
    public function create()
    {
        return view('user.academic_records.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'qualification_code' => 'required|string|max:255',
            'qualification_name' => 'required|string|max:255',
            'qualification_cadre' => 'required|string|max:255',
            'graduation_date' => 'required|date|before_or_equal:2025-01-01',

            'institution_name' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf|max:2048', // Only allow PDF files
        ]);

        try {
            // Store the file
            $filePath = $request->file('file')->store('user.academic_records');

            // Create the academic record
            AcademicRecord::create([
                'qualification_code' => $validated['qualification_code'],
                'qualification_name' => $validated['qualification_name'],
                'qualification_cadre' => $validated['qualification_cadre'],
                'graduation_date' => $validated['graduation_date'],
                'institution_name' => $validated['institution_name'],
                'file_path' => $filePath,
                'user_id' => Auth::id(),
            ]);

            return redirect()->route('academic_records.index')->with('success', 'Academic record created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to create academic record. Please try again.'])
                ->withInput();
        }
    }
    public function edit($id)
    {
        $academicRecord = AcademicRecord::findOrFail($id); // Retrieve the academic record by ID
        return view('user.academic_records.edit', compact('academicRecord'));
    }
    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'qualification_code' => 'required|string|max:255',
            'qualification_name' => 'required|string|max:255',
            'qualification_cadre' => 'required|string|max:255',
            'graduation_date' => 'required|date',
            'institution_name' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf|max:2048', // Only allow PDF files
        ]);
    
        try {
            $academicRecord = AcademicRecord::findOrFail($id);
            
            // Update the academic record details
            $academicRecord->qualification_code = $validated['qualification_code'];
            $academicRecord->qualification_name = $validated['qualification_name'];
            $academicRecord->qualification_cadre = $validated['qualification_cadre'];
            $academicRecord->graduation_date = $validated['graduation_date'];
            $academicRecord->institution_name = $validated['institution_name'];
        
            // If a new file is uploaded, store it and update the file path
            if ($request->hasFile('file')) {
                $filePath = $request->file('file')->store('user.academic_records');
                $academicRecord->file_path = $filePath;
            }
        
            $academicRecord->save(); // Save the changes
        
            return redirect()->route('academic_records.index')->with('success', 'Academic record updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to update academic record. Please try again.'])
                ->withInput();
        }
    }
    public function index()
    {
        $records = AcademicRecord::where('user_id', Auth::id())->get();
        return view('user.academic_records.index', compact('records'));
    }
    public function destroy($id)
{
    $academicRecord = AcademicRecord::findOrFail($id);
    $academicRecord->delete(); // Delete the record

    return redirect()->route('academic_records.index')->with('success', 'Academic record deleted successfully.');
}
}
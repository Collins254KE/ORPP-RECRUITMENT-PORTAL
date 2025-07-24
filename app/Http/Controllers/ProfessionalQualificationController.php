<?php

namespace App\Http\Controllers;
use App\Models\ProfessionalMembership;

use App\Models\ProfessionalQualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfessionalQualificationController extends Controller
{
    public function create()
    {
        return view('user.professional_qualifications.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'level' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'required|file|mimes:pdf|max:2048', // Only allow PDF files
        ]);

        try {
            // Store the file
            $filePath = $request->file('file')->store('user.professional_qualifications');

            // Create the professional qualification
            ProfessionalQualification::create([
                'level' => $validated['level'],
                'description' => $validated['description'],
                'file_path' => $filePath,
                'user_id' => Auth::id(),
            ]);

            return redirect()->route('professional_qualifications.index')->with('success', 'Professional qualification created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to create professional qualification. Please try again.'])
                ->withInput();
        }
    }
    public function edit($id)
    {
        $qualification = ProfessionalQualification::findOrFail($id); // Retrieve the qualification by ID
        return view('user.professional_qualifications.edit', compact('qualification'));
    }
    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'level' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'nullable|file|mimes:pdf|max:2048', // Only allow PDF files
        ]);
    
        try {
            $qualification = ProfessionalQualification::findOrFail($id);
            
            // Update the qualification details
            $qualification->level = $validated['level'];
            $qualification->description = $validated['description'];
        
            // If a new file is uploaded, store it and update the file path
            if ($request->hasFile('file')) {
                $filePath = $request->file('file')->store('user.professional_qualifications');
                $qualification->file_path = $filePath;
            }
        
            $qualification->save(); // Save the changes
        
            return redirect()->route('professional_qualifications.index')->with('success', 'Professional qualification updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to update professional qualification. Please try again.'])
                ->withInput();
        }
    }
 public function index()
{
    $qualifications = ProfessionalQualification::where('user_id', auth()->id())->get();

    return view('user.professional_qualifications.index', compact('qualifications'));
}


    public function destroy($id)
{
    $employmentHistory = ProfessionalQualification::findOrFail($id);
    $employmentHistory->delete(); // Delete the record

    return redirect()->route('professional_qualifications.index')->with('success', 'Professional qualification deleted successfully.');
}
}
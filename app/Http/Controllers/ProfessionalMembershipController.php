<?php

namespace App\Http\Controllers;

use App\Models\ProfessionalMembership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfessionalMembershipController extends Controller
{
    public function create()
    {
        return view('user.professional_memberships.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'file' => 'required|file|mimes:pdf|max:2048', // Only allow PDF files
        ]);

        // Store the file
        $filePath = $request->file('file')->store('user.professional_memberships');

        // Create the professional membership
        ProfessionalMembership::create([
            'description' => $request->description,
            'file_path' => $filePath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('professional_memberships.index')->with('success', 'Professional membership created successfully.');
    }
    public function edit($id)
    {
        $membership = ProfessionalMembership::findOrFail($id); // Retrieve the membership by ID
        return view('user.professional_memberships.edit', compact('membership'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string',
            'file' => 'nullable|file|mimes:pdf|max:2048', // Only allow PDF files
        ]);
    
        $membership = ProfessionalMembership::findOrFail($id);
        
        // Update the membership details
        $membership->description = $request->description;
    
        // If a new file is uploaded, store it and update the file path
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('user.professional_memberships');
            $membership->file_path = $filePath;
        }
    
        $membership->save(); // Save the changes
    
        return redirect()->route('professional_memberships.index')->with('success', 'Professional membership updated successfully.');
    }
    public function index()
{
    $professional_memberships = ProfessionalMembership::where('user_id', Auth::id())->get();
    return view('user.professional_memberships.index', compact('professional_memberships'));
}

    public function destroy($id)
{
    $employmentHistory = ProfessionalMembership::findOrFail($id);
    $employmentHistory->delete(); // Delete the record

    return redirect()->route('professional_memberships.index')->with('success', 'Professional membership deleted successfully.');
}
}
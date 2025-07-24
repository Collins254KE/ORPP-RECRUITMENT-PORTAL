<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Referee;
use Illuminate\Support\Facades\Auth;

class RefereeController extends Controller
{
    
    public function create()
    {
        return view('user.referees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'other_name' => 'nullable|string|max:255',
            'organization' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'postal_address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'city_town' => 'required|string|max:255',
            'referee_type' => 'required|in:professional,personal', // Validate referee type
            'email' => 'required|email|max:255',
            'mobile_phone' => 'required|string|max:20',
            
        ]);

        // Create the referee record
        Referee::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'other_name' => $request->other_name,
            'organization' => $request->organization,
            'designation' => $request->designation,
            'postal_address' => $request->postal_address,
            'postal_code' => $request->postal_code,
            'city_town' => $request->city_town,
            'referee_type' => $request->referee_type,
            'email'=> $request->email,
            'mobile_phone' => $request->mobile_phone,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('referees.index')->with('success', 'Referee added successfully.');
    }
    public function edit($id)
    {
        $referee = Referee::findOrFail($id); // Retrieve the referee by ID
        return view('user.referees.edit', compact('referee'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'other_name' => 'nullable|string|max:255',
            'organization' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'postal_address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'city_town' => 'required|string|max:255',
            'referee_type' => 'required|in:professional,personal',
            'email' => 'required|email|max:255',
            'mobile_phone' => 'required|string|max:20',
        ]);
    
        // Update the referee record
        $referee = Referee::findOrFail($id);
        $referee->update($request->all());
    
        return redirect()->route('referees.index')->with('success', 'Referee updated successfully.');
    }

    public function index()
    {
        $referees = Referee::where('user_id', Auth::id())->get();
        return view('user.referees.index', compact('referees'));
    }
    public function destroy($id)
{
    $referee = Referee::findOrFail($id);
    $referee->delete(); // Delete the record

    return redirect()->route('referees.index')->with('success', 'Referee deleted successfully.');
}
}

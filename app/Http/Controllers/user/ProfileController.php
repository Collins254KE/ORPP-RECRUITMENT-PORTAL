<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use App\Models\AcademicRecord;
use App\Models\ProfessionalQualification;
use App\Models\ProfessionalMembership;
use App\Models\EmploymentHistory;
use App\Models\Referee;

class ProfileController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        return view('user.profile', [
            'user' => Auth::user(),
            'records' => AcademicRecord::where('user_id', $userId)->get(),
            'qualifications' => ProfessionalQualification::where('user_id', $userId)->get(),
            'memberships' => ProfessionalMembership::where('user_id', $userId)->get(),
            'employmentHistories' => EmploymentHistory::where('user_id', $userId)->get(),
            'referees' => Referee::where('user_id', $userId)->get(),
        ]);
    }

    public function updatePersonalDetails(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:10',
            'id_passport' => 'required|string|max:50',
            'kra_pin' => ['required', 'string', 'max:16', 'regex:/^[A-Za-z0-9]+$/'],
            'county' => 'required|string|max:255',
            'sub_county' => 'required|string|max:255',
            'ethnicity' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'gender' => 'required|string|max:10',
            'dob' => 'required|date',
            'disability_status' => 'required|string|in:yes,no',
            'disability_certificate_number' => 'required_if:disability_status,yes|nullable|string|max:25',
        ]);

        $user->update($request->only([
            'name', 'title', 'phone', 'id_passport', 'kra_pin',
            'county', 'sub_county', 'ethnicity', 'nationality',
            'gender', 'dob', 'disability_status', 'disability_certificate_number'
        ]));

        return redirect()->route('profile')->with('success', 'Personal details updated successfully.');
    }

    public function updateEducation(Request $request)
    {
        $request->validate([
            'qualification_code' => 'required|string|max:255',
            'course_name' => 'required|string|max:255',
            'qualification_grade' => 'required|string|max:255',
            'graduation_date' => 'required|date',
            'institution_name' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf|max:2048',
        ]);

        $filePath = $request->file('file')->store('academic_records');

        AcademicRecord::create([
            'qualification_code' => $request->qualification_code,
            'course_name' => $request->course_name,
            'qualification_grade' => $request->qualification_grade,
            'graduation_date' => $request->graduation_date,
            'institution_name' => $request->institution_name,
            'file_path' => $filePath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('profile')->with('success', 'Education background updated successfully.');
    }

    public function updateQualifications(Request $request)
    {
        $request->validate([
            'level' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'required|file|mimes:pdf|max:2048',
        ]);

        $filePath = $request->file('file')->store('professional_qualifications');

        ProfessionalQualification::create([
            'level' => $request->level,
            'description' => $request->description,
            'file_path' => $filePath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('profile')->with('success', 'Professional qualifications updated successfully.');
    }

    public function updateMemberships(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'file' => 'required|file|mimes:pdf|max:2048',
        ]);

        $filePath = $request->file('file')->store('professional_memberships');

        ProfessionalMembership::create([
            'description' => $request->description,
            'file_path' => $filePath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('profile')->with('success', 'Professional memberships updated successfully.');
    }

    public function updateEmploymentHistory(Request $request)
    {
        $request->validate([
            'employer_name' => 'required|string|max:255',
            'job_position' => 'required|string|max:255',
            'date_joined' => 'required|date',
            'date_left' => 'nullable|date',
            'roles_responsibilities' => 'required|string|max:250',
        ]);

        EmploymentHistory::create([
            'employer_name' => $request->employer_name,
            'job_position' => $request->job_position,
            'date_joined' => $request->date_joined,
            'date_left' => $request->date_left,
            'roles_responsibilities' => $request->roles_responsibilities,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('profile')->with('success', 'Employment history updated successfully.');
    }

    public function uploadDocuments(Request $request)
    {
        $request->validate([
            'cover_letter' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('cover_letter')) {
            $request->file('cover_letter')->store('uploads/cover_letters');
        }

        if ($request->hasFile('cv')) {
            $request->file('cv')->store('uploads/cvs');
        }

        return redirect()->route('profile')->with('success', 'Documents uploaded successfully.');
    }

    public function updateReferences(Request $request)
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
            'mobile_phone' => 'required|digits:10',
        ]);

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
            'email' => $request->email,
            'mobile_phone' => $request->mobile_phone,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('profile')->with('success', 'References updated successfully.');
    }

    public function myApplications()
    {
        $applications = Application::with('jobListing')
            ->where('user_id', Auth::id())
            ->paginate(10);

        return view('user.my_applications', compact('applications'));
    }

    public function applyNow()
    {
        $applications = Application::with('jobListing')
            ->paginate(10);

        return view('user.my_applications', compact('applications'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\AcademicRecord;
use App\Models\ProfessionalQualification;
use App\Models\ProfessionalMembership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Download academic record file
     */
    public function downloadAcademicRecord($id)
    {
        $query = AcademicRecord::where('id', $id);
        
        // If user is not admin, restrict to their own files
        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }
        
        $record = $query->firstOrFail();

        if (!Storage::exists($record->file_path)) {
            abort(404, 'File not found.');
        }

        return Storage::download($record->file_path);
    }

    /**
     * Download professional qualification file
     */
    public function downloadProfessionalQualification($id)
    {
        $query = ProfessionalQualification::where('id', $id);
        
        // If user is not admin, restrict to their own files
        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }
        
        $qualification = $query->firstOrFail();

        if (!Storage::exists($qualification->file_path)) {
            abort(404, 'File not found.');
        }

        return Storage::download($qualification->file_path);
    }

    /**
     * Download professional membership file
     */
    public function downloadProfessionalMembership($id)
    {
        $query = ProfessionalMembership::where('id', $id);
        
        // If user is not admin, restrict to their own files
        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }
        
        $membership = $query->firstOrFail();

        if (!Storage::exists($membership->file_path)) {
            abort(404, 'File not found.');
        }

        return Storage::download($membership->file_path);
    }

    /**
     * View academic record file in browser
     */
    public function viewAcademicRecord($id)
    {
        $query = AcademicRecord::where('id', $id);
        
        // If user is not admin, restrict to their own files
        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }
        
        $record = $query->firstOrFail();

        if (!Storage::exists($record->file_path)) {
            abort(404, 'File not found.');
        }

        return response()->file(Storage::path($record->file_path));
    }

    /**
     * View professional qualification file in browser
     */
    public function viewProfessionalQualification($id)
    {
        $query = ProfessionalQualification::where('id', $id);
        
        // If user is not admin, restrict to their own files
        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }
        
        $qualification = $query->firstOrFail();

        if (!Storage::exists($qualification->file_path)) {
            abort(404, 'File not found.');
        }

        return response()->file(Storage::path($qualification->file_path));
    }

    /**
     * View professional membership file in browser
     */
    public function viewProfessionalMembership($id)
    {
        $query = ProfessionalMembership::where('id', $id);
        
        // If user is not admin, restrict to their own files
        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }
        
        $membership = $query->firstOrFail();

        if (!Storage::exists($membership->file_path)) {
            abort(404, 'File not found.');
        }

        return response()->file(Storage::path($membership->file_path));
    }
} 
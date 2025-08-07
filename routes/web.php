<?php
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\ApplicationController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\AcademicRecordController;
use App\Http\Controllers\ApplicationsController;  
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmploymentHistoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\ProfessionalMembershipController;
use App\Http\Controllers\ProfessionalQualificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RefereeController;
use App\Mail\ApplicationReceived;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\user\DashboardController;
use App\Mail\ShortlistedNotification;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */

// Email verification notice view
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->name('verification.notice');

// Email verification link handler
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

// Resend verification email
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/admin/applications', [ApplicationsController::class, 'index']);
Route::get('/auth/ecitizen-login', function () {
    return view('auth.ecitizen-login');
});

Route::get('/admin/applications', [ApplicationsController::class, 'index'])->name('admin.applicants.index');
Route::get('admin/applicants/filter', [ApplicationsController::class, 'filter'])->name('admin.applicants.filter');

Route::get('/admin/applications/{id}', [ApplicationsController::class, 'show'])->name('admin.applications.show');
Route::put('/admin/applications/{id}', [ApplicationsController::class, 'update'])->name('admin.applications.update');

Route::get('/admin/applications/export/{job_id}', [ApplicationsController::class, 'exportApplicants'])
    ->name('admin.applications.export');

Route::get('/applications/{id}/document', [ApplicationsController::class, 'viewDocument'])->name('applications.document');

Route::get('/applications', [App\Http\Controllers\ApplicationsController::class, 'index']);

Route::get('/', function () {
    return view('auth.login');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'welcome'])->name('home');
});

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');


// Admin application management
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/applications', [ApplicationsController::class, 'index'])->name('admin.applications.index');
    Route::get('admin/applicants/filter', [ApplicationsController::class, 'filter'])->name('admin.applicants.filter');

    Route::get('/admin/applications/{id}', [ApplicationsController::class, 'showApplication'])->name('admin.applications.show');
    Route::put('/admin/applications/{id}', [ApplicationsController::class, 'update'])->name('admin.applications.update');  // if you add update method for status change
    Route::get('/admin/applications/{job_id}/filter-applicants', [ApplicationsController::class, 'filterApplicants'])->name('admin.applicants.filtered');
    Route::get('/admin/applications/{job_id}/export', [ApplicationsController::class, 'exportApplicants'])->name('admin.applicants.export');
});

// User job listings and applications
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/jobs', [ApplicationsController::class, 'userApplications'])->name('user.applications');
    Route::post('/jobs/{id}/apply', [ApplicationsController::class, 'apply'])->name('jobs.apply');
    Route::get('/jobs/{id}', [ApplicationsController::class, 'show'])->name('jobs.show');
    Route::get('/applications/{id}', [ApplicationsController::class, 'showApplication'])->name('user.application_detail');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/job-listings', [App\Http\Controllers\admin\JobController::class, 'index'])->name('admin.job-listings.index');
    Route::get('/admin/job-listings/create', [App\Http\Controllers\admin\JobController::class, 'create'])->name('admin.job-listings.create');
    Route::post('/admin/job-listings', [App\Http\Controllers\admin\JobController::class, 'store'])->name('admin.job-listings.store');
    Route::get('/admin/job-listings/{id}/edit', [App\Http\Controllers\admin\JobController::class, 'edit'])->name('admin.job-listings.edit');
    Route::put('/admin/job-listings/{id}', [App\Http\Controllers\admin\JobController::class, 'update'])->name('admin.job-listings.update');
    Route::delete('/admin/job-listings/{id}', [App\Http\Controllers\admin\JobController::class, 'destroy'])->name('admin.job-listings.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/login', function () {
        return redirect('/');
    });
});

Route::get('/jobs', [PublicJobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{id}', [PublicJobController::class, 'show'])->name('jobs.show');

Route::get('/admin/jobs/{job_id}/download-documents', [ApplicationsController::class, 'downloadAllDocuments'])
    ->name('admin.jobs.downloadDocuments')
    ->middleware('auth', 'can:admin');

Route::get('/application/{id}/document', [ApplicationsController::class, 'viewDocument'])->name('application.viewDocument');

Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');

Route::get('/documents/{filename}', [DocumentController::class, 'show'])->name('documents.show');

Route::post('/applications/apply/{id}', [ApplicationsController::class, 'apply'])->name('applications.apply');
Route::middleware(['web', 'auth'])->group(function () {
    Route::post('/applications/apply/{id}', [ApplicationsController::class, 'apply'])->name('applications.apply');
    Route::get('/user/applications', [ApplicationsController::class, 'userApplications'])->name('user.applications');
});

Route::get('admin/applicants/filter', [ApplicationsController::class, 'filter'])->name('admin.applicants.filter');

Route::get('/auth/login', [App\Http\Controllers\AuthController::class, 'userLogin'])->name('login');
Route::get('/auth/register', [App\Http\Controllers\AuthController::class, 'userRegistration']);
Route::post('/auth/signin', [App\Http\Controllers\AuthController::class, 'signin']);
Route::post('/auth/signup', [App\Http\Controllers\AuthController::class, 'signup']);

Route::get('password/reset', [AuthController::class, 'showResetForm'])->name('password.request');
Route::post('/auth/send-reset-link', [AuthController::class, 'sendResetLinkEmail']);
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('/password/update', [ResetPasswordController::class, 'reset'])->name('password.update');

// add user routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\user\DashboardController::class, 'index'])->name('dashboard');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/profile', [ProfileController::class, 'index']);

    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/profile', [App\Http\Controllers\user\ProfileController::class, 'index'])->name('profile');
    Route::get('/my-applications', [App\Http\Controllers\user\ProfileController::class, 'myApplications'])->name('my-applications');
    Route::post('/profile/update/personal', [App\Http\Controllers\user\ProfileController::class, 'updatePersonalDetails'])->name('profile.update.personal');
    Route::post('/profile/update/education', [App\Http\Controllers\user\ProfileController::class, 'updateEducation'])->name('profile.update.education');
    Route::post('/profile/update/qualifications', [App\Http\Controllers\user\ProfileController::class, 'updateQualifications'])->name('profile.update.qualifications');
    Route::post('/profile/update/memberships', [App\Http\Controllers\user\ProfileController::class, 'updateMemberships'])->name('profile.update.memberships');
    Route::post('/profile/update/employment', [App\Http\Controllers\user\ProfileController::class, 'updateEmploymentHistory'])->name('profile.update.employment');
    Route::post('/profile/upload', [App\Http\Controllers\user\ProfileController::class, 'uploadDocuments'])->name('profile.upload');
    Route::post('/profile/update/references', [App\Http\Controllers\user\ProfileController::class, 'updateReferences'])->name('profile.update.references');
    Route::get('/applications', [App\Http\Controllers\ApplicationsController::class, 'userApplications'])->name('user.applications');
    Route::get('/applications/apply/{id}', [App\Http\Controllers\ApplicationsController::class, 'apply'])->name('applications.apply');
    Route::get('/applications/show/{id}', [App\Http\Controllers\ApplicationsController::class, 'show'])->name('applications.show');
    

    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::resource('academic_records', AcademicRecordController::class);

    Route::get('/academic-records/create', [AcademicRecordController::class, 'create'])->name('academic_records.create');
    Route::post('/academic-records', [AcademicRecordController::class, 'store'])->name('academic_records.store');
    Route::get('/academic-records', [AcademicRecordController::class, 'index'])->name('academic_records.index');
    Route::get('/academic-records/{id}/edit', [AcademicRecordController::class, 'edit'])->name('academic_records.edit');
    Route::put('/academic-records/{id}', [AcademicRecordController::class, 'update'])->name('academic_records.update');

    Route::resource('professional_qualifications', ProfessionalQualificationController::class);

    Route::resource('professional_memberships', ProfessionalMembershipController::class);

    Route::get('/', function () {
        return view('auth.login');  // assuming your login view is in resources/views/auth/login.blade.php
    });

    Route::get('/login', [AuthController::class, 'userLogin'])->name('login');

    Route::get('admin/job-listings/{id}', [JobController::class, 'show'])->name('admin.job-listings.show');

    Route::get('/admin/job-listings/{id}', [JobListingController::class, 'show'])->name('admin.job-listings.show');
    Route::post('/admin/job-listings', [JobListingController::class, 'store'])->name('admin.job-listings.store');

    Route::get('/employment-history/create', [EmploymentHistoryController::class, 'create'])->name('employment_history.create');
    Route::post('/employment-history', [EmploymentHistoryController::class, 'store'])->name('employment_history.store');
    Route::get('/employment-history', [EmploymentHistoryController::class, 'index'])->name('employment_history.index');
    Route::get('/employment-history/{id}/edit', [EmploymentHistoryController::class, 'edit'])->name('employment_history.edit');

    Route::delete('/employment-history/{id}', [EmploymentHistoryController::class, 'destroy'])->name('employment_history.destroy');

    Route::put('/employment-history/{id}', [EmploymentHistoryController::class, 'update'])->name('employment_history.update');

    Route::put('/admin/job-listings/{id}', [JobListingController::class, 'update'])->name('admin.job-listings.update');

    Route::get('/admin/job-listings/{id}', [JobController::class, 'show'])->name('admin.job-listings.show');
    Route::get('/admin/job-listings/{id}', [JobListingController::class, 'show'])->name('admin.job-listings.show');

    Route::resource('referees', RefereeController::class);

    Route::get('/referees/create', [RefereeController::class, 'create'])->name('referees.create');
    Route::post('/referees', [RefereeController::class, 'store'])->name('referees.store');
    Route::get('/referees', [RefereeController::class, 'index'])->name('referees.index');
    Route::get('/referees/{id}/edit', [RefereeController::class, 'edit'])->name('referees.edit');
    Route::delete('/referees/{id}', [RefereesController::class, 'destroy'])->name('referees.destroy');
    Route::put('/referees/{id}', [RefereeController::class, 'update'])->name('referees.update');

    // Route::resource('referees', RefereeController::class);

    Route::get('/applications/{id}/document', [ApplicationController::class, 'viewDocument'])->name('applications.document');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/job-listings/create', [App\Http\Controllers\admin\JobController::class, 'create'])->name('admin.job-listings.create');
    Route::post('/admin/job-listings', [App\Http\Controllers\admin\JobController::class, 'store'])->name('admin.job-listings.store');
    Route::get('/admin/job-listings/{id}/edit', [App\Http\Controllers\admin\JobController::class, 'edit'])->name('admin.job-listings.edit');
    Route::put('/admin/job-listings/{id}', [App\Http\Controllers\admin\JobController::class, 'update'])->name('admin.job-listings.update');
    Route::delete('/admin/job-listings/{id}', [App\Http\Controllers\admin\JobController::class, 'destroy'])->name('admin.job-listings.destroy');
    // admin applications routes
    Route::get('/admin/applications', [App\Http\Controllers\admin\ApplicationController::class, 'index'])->name('admin.applications.index');
    Route::get('/admin/applications/{id}', [App\Http\Controllers\admin\ApplicationController::class, 'show'])->name('admin.applications.show');
    Route::put('/admin/applications/{id}', [App\Http\Controllers\admin\ApplicationController::class, 'update'])->name('admin.applications.update');

    // File access routes for secure document viewing and downloading
    Route::get('/files/academic-record/{id}/view', [FileController::class, 'viewAcademicRecord'])->name('files.academic_record.view');
    Route::get('/files/academic-record/{id}/download', [FileController::class, 'downloadAcademicRecord'])->name('files.academic_record.download');
    Route::get('/files/professional-qualification/{id}/view', [FileController::class, 'viewProfessionalQualification'])->name('files.professional_qualification.view');
    Route::get('/files/professional-qualification/{id}/download', [FileController::class, 'downloadProfessionalQualification'])->name('files.professional_qualification.download');
    Route::get('/files/professional-membership/{id}/view', [FileController::class, 'viewProfessionalMembership'])->name('files.professional_membership.view');
    Route::get('/files/professional-membership/{id}/download', [FileController::class, 'downloadProfessionalMembership'])->name('files.professional_membership.download');
});

Route::get('/send-test-email', function () {
    $dummyUser = (object) [
        'name' => 'Jane Applicant',
        'email' => 'orpprecruitment@gmail.com',
        'job_title' => 'Records Officer'
    ];

    Mail::to($dummyUser->email)->send(new \App\Mail\ApplicationReceived($dummyUser));

    return 'Test email sent!';
});

Route::get('/register', function () {
    return view('auth.register');  // Adjust path if your view is elsewhere
})->name('register');
Route::put('/user/{user}', [UserController::class, 'update'])
    ->middleware('can:update,user');

Route::get('/admin/applications/{id}/document', [ApplicationsController::class, 'viewDocument'])->name('admin.applications.document');
Route::get('/admin/applications/{id}/document', [ApplicationsController::class, 'viewDocument'])->name('admin.applications.viewDocument');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);

Route::get('/admin/applications/{id}/view-document', [ApplicationsController::class, 'viewDocument'])->name('applications.viewDocument');
Route::get('/admin/reports/applicant-summary', [ReportController::class, 'applicantSummary'])->name('admin.reports.applicant-summary');

use App\Http\Controllers\ReportController;

Route::get('/admin/reports/applicant-summary', [ReportController::class, 'applicantSummary'])->name('admin.reports.applicant-summary');
Route::get('/admin/reports/applicant-summary-export', [ReportController::class, 'exportApplicantSummary'])->name('admin.reports.applicant-summary-export');
Route::get('/admin/applications/report', [ApplicationsController::class, 'generateReport'])->name('admin.applications.report');

Route::get('email/verify', [VerificationController::class, 'show'])
    ->middleware('auth')
    ->name('verification.notice');

Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('email/resend', [VerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.resend');
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // other admin routes...
});
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Application analytics
    Route::get('/analytics', [ApplicationController::class, 'analytics'])
        ->name('admin.applications.analytics');

    // Admin dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::get('/admin/applications/report/{job}', [ApplicationsController::class, 'report'])
        ->name('admin.applications.report');
    Route::get('/admin/applications/report', [ApplicationsController::class, 'report'])->name('admin.applications.report');

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
});
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    auth()->logout();  // Log user out

    return redirect()->route('login')->with('success', 'Email verified successfully. Please login.');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect(RouteServiceProvider::HOME);  // ← redirects to /login or defined HOME
})->middleware(['auth', 'signed'])->name('verification.verify');

// Log the user out after verification (if needed)

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    #$request->fulfill();
    #Auth::logout();  // Force logout if verified before login
    #return redirect('/login')->with('verified', true);
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::middleware(['auth', 'verified_or_admin'])->group(function () {
    // Routes for both verified users and admins
});

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');



Route::middleware(['auth', 'verified_or_admin'])->group(function () {
    #Route::get('/dashboard', [DashboardController::class, 'index']);
});

  Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
});


Auth::routes(['verify' => true]);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/admin/applications/send-shortlist-emails', [ApplicationsController::class, 'sendShortlistEmails'])->name('admin.applications.sendShortlistEmails');

Route::get('/forgot-password', function () {
    return view('auth.custom-forgot-password-form');
})->name('password.request');


Route::get('/test-reset', function () {
    return view('auth.custom-reset-password-form', [
        'token' => 'test-token',
        'email' => 'collinskiprotich2028@gmail.com', 
    ]);
});

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Employer\JobPostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\JobApprovalController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\SavedJobController;
use App\Http\Controllers\Employer\ApplicantController;
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs/{job}', [HomeController::class, 'show'])->name('jobs.show');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:employer'])
    ->prefix('employer')->name('employer.')->group(function () {
        Route::resource('jobs', JobPostController::class)->except('show');
        Route::get('jobs/{job}/applicants', [ApplicantController::class, 'index'])->name('applicants.index');
        Route::patch('applications/{application}', [ApplicantController::class, 'update'])->name('applicants.update');
        });
    
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')->name('admin.')->group(function () {
        Route::get('jobs', [JobApprovalController::class, 'index'])->name('jobs.index');
        Route::patch('jobs/{job}', [JobApprovalController::class, 'update'])->name('jobs.update');

        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::patch('users/{user}/toggle', [UserController::class, 'toggle'])->name('users.toggle');

        Route::resource('categories', CategoryController::class)->only(['index', 'store', 'update', 'destroy']);
    });   
    Route::middleware(['auth', 'role:candidate'])->group(function () {
    Route::get('/my-applications', [ApplicationController::class, 'index'])->name('candidate.applications');
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('jobs.apply');
    Route::get('/saved-jobs', [SavedJobController::class, 'index'])->name('candidate.saved');
    Route::post('/jobs/{job}/save', [SavedJobController::class, 'toggle'])->name('jobs.save');
});
require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Employer\JobPostController;
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
    });
    
require __DIR__.'/auth.php';

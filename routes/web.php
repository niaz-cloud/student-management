<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Breeze profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ✅ Students UI routes
    Route::resource('students', StudentController::class);

    // ✅ Optional filters (ONLY if these methods exist in StudentController)
    Route::get('/students/division/{division}', [StudentController::class, 'byDivision'])
        ->name('students.byDivision');

    Route::get('/students/district/{district}', [StudentController::class, 'byDistrict'])
        ->name('students.byDistrict');

    // If you have this method, you can enable it:
    // Route::get('/students/division/{division}/district/{district}', [StudentController::class, 'byDivisionDistrict'])
    //     ->name('students.byDivisionDistrict');
});

require __DIR__.'/auth.php';

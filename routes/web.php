<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/students/division/{division}', [StudentController::class, 'byDivision'])
    ->name('students.byDivision');

Route::get('/students/district/{district}', [StudentController::class, 'byDistrict'])
    ->name('students.byDistrict');

Route::resource('students', StudentController::class);

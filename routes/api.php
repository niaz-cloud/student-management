<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;

Route::get('/students', [StudentController::class, 'index']);        // list
Route::get('/students/{student}', [StudentController::class, 'show']); // single
Route::post('/students', [StudentController::class, 'store']);       // create
Route::put('/students/{student}', [StudentController::class, 'update']); // update
Route::delete('/students/{student}', [StudentController::class, 'destroy']); // delete
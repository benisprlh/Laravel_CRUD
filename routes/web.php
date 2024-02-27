<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [StudentController::class, 'index'])->name('student.index');
Route::get('/search', [StudentController::class, 'search'])->name('search');
Route::get('/create', [StudentController::class, 'create'])->name('student.create');
Route::post('/', [StudentController::class, 'store'])->name('student.store');
Route::get('/{student}/edit', [StudentController::class, 'edit'])->name('student.edit');
Route::put('/{student}/update', [StudentController::class, 'update'])->name('student.update');
Route::delete('/{student}/destroy', [StudentController::class, 'destroy'])->name('student.destroy');


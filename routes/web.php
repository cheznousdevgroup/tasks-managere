<?php

use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [TasksController::class, 'index'])->name('index');

// Route::get('/tache/create', [TasksController::class, 'create'])->name('create');
// Route::post('/tache/cree', [TasksController::class, 'store'])->name('store');
// Route::get('/tache/edit/{id}', [TasksController::class, 'edit'])->name('edit');
// Route::put('/tache/update/{id}', [TasksController::class, 'update'])->name('update');
// Route::delete('/tache/delete/{id}', [TasksController::class, 'destroy'])->name('destroy');
Route::resource('/tache',TasksController::class);
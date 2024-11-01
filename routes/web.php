<?php

use App\Jobs\ProcessQueueJob;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('tasks_index');
});

use App\Http\Controllers\TaskController;

Route::get('tasks', [TaskController::class, 'index'])->name('tasks_index');
Route::post('tasks', [TaskController::class, 'store'])->name('tasks_store');
Route::patch('tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');

Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users_index');
Route::post('users', [\App\Http\Controllers\UserController::class, 'store'])->name('users_store');



use App\Http\Controllers\SseController;

Route::get('/sse', [SseController::class, 'stream']);

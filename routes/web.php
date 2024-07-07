<?php

use App\Http\Controllers\StudentController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group( function () {
    Route::get('/student', [StudentController::class, 'index']);
});

Route::post('/store/student', [StudentController::class, 'store'])->name('add-student');
Route::post('/pusher/auth', [StudentController::class, 'pusherAuth']);
Route::get('/page/student', [StudentController::class, 'create']);

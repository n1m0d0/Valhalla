<?php

use App\Http\Controllers\PageController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::controller(PageController::class)->group(function () {
    Route::get('user', 'user')->name('page.user')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('question', 'question')->name('page.question')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('treatment', 'treatment')->name('page.treatment')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('patient', 'patient')->name('page.patient')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('file/{patient}', 'file')->name('page.file')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('phone/{patient}', 'phone')->name('page.phone')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('address/{patient}', 'address')->name('page.address')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('meeting/{patient}', 'meeting')->name('page.meeting')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('detail/{patient}', 'detail')->name('page.detail')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('calendar', 'calendar')->name('page.calendar')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('program', 'program')->name('page.program')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('consultation', 'consultation')->name('page.consultation')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('diagnostic/{patient}', 'diagnostic')->name('page.diagnostic')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
});
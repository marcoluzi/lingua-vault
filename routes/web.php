<?php

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

Route::view('/', 'home')->name('home');

// Lessons
Route::group(['prefix' => 'lessons', 'as' => 'lessons.'], function () {
    Route::get('/', \App\Livewire\Pages\Lessons::class)->name('index');
});

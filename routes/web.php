<?php

use App\Livewire\Pages;
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

Route::get('/', Pages\Home::class)->name('home');

// Lessons
Route::group(['prefix' => 'lessons', 'as' => 'lessons.'], function () {
    Route::get('/', Pages\Lessons::class)->name('index');
    Route::get('create', Pages\LessonCreate::class)->name('create');
});

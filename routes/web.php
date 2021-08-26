<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('language/{locale}', [LanguageController::class, 'index'])->name('language.index');
Route::resources([
    'questions' => 'QuestionController',
]);
Route::get('/admin', [AdminController::class, 'index'])->name('home');
Route::get('/user-management', [AdminController::class, 'managerUser'])->name('user-management');
Route::get('/question-management', [AdminController::class, 'managerQuestion'])->name('question-management');

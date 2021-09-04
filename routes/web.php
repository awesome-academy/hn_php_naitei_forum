<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SearchController;

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
Route::post('/delete-question/{id}', [AdminController::class, 'deleteQuestion'])->name('delete-question');
Route::post('/active-question/{id}', [AdminController::class, 'activeQuestion'])->name('active-question');
Route::post('/inactive-question/{id}', [AdminController::class, 'inactiveQuestion'])->name('inactive-question');
Route::post('/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('delete-user');
Route::post('/active-user/{id}', [AdminController::class, 'activeUser'])->name('active-user');
Route::post('/inactive-user/{id}', [AdminController::class, 'inactiveUser'])->name('inactive-user');

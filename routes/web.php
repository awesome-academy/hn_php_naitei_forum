<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MyAnswerController;
use App\Http\Controllers\MyQuestionController;
use App\Http\Controllers\ProfileController;
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
Route::resource('questions', 'QuestionController')->except('show');
Route::resource('answers', 'AnswerController');
Route::post('/answers/{answer}/accept', 'AcceptAnswerController')->name('answers.accept');
Route::get('/questions/{slug}', 'QuestionController@show')->name('questions.show');
Route::post('/questions/{question_id}/vote', 'VoteQuestionController@voteQuestion')
        ->middleware('auth')->name('vote.question');
Route::post('/answers/{answer_id}/vote', 'VoteAnswerController@voteAnswer')
        ->middleware('auth')->name('vote.answer');
Route::post('/answers/{answer}/accept', 'AcceptAnswerController')->name('answers.accept');
Route::post('/questions/{question}/favorites', 'FavoritesController@store')
        ->middleware('auth')->name('questions.favorite');
Route::delete('/questions/{question}/favorites', 'FavoritesController@destroy')
        ->middleware('auth')->name('questions.unfavorite');

Route::get('/admin', [AdminController::class, 'index'])->name('home');
Route::get('/user-management', [AdminController::class, 'managerUser'])->name('user-management');
Route::get('/question-management', [AdminController::class, 'managerQuestion'])->name('question-management');
Route::post('/delete-question/{id}', [AdminController::class, 'deleteQuestion'])->name('delete-question');
Route::post('/active-question/{id}', [AdminController::class, 'activeQuestion'])->name('active-question');
Route::post('/inactive-question/{id}', [AdminController::class, 'inactiveQuestion'])->name('inactive-question');
Route::post('/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('delete-user');
Route::post('/active-user/{id}', [AdminController::class, 'activeUser'])->name('active-user');
Route::post('/inactive-user/{id}', [AdminController::class, 'inactiveUser'])->name('inactive-user');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/my-questions', [MyQuestionController::class, 'index'])->name('my-questions');
Route::get('/my-answers', [MyAnswerController::class, 'index'])->name('my-answers');

<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Question $question)
    {
        $question->favoriteUsers()->attach(Auth::user()->id);
        $countFavorites = $question->favoriteUsers()->count();
        Question::where('id', $question->id)->update(['favorites' => $countFavorites]);

        return back();
    }

    public function destroy(Question $question)
    {
        $question->favoriteUsers()->detach(Auth::user()->id);
        $countFavorites = $question->favoriteUsers()->count();
        Question::where('id', $question->id)->update(['favorites' => $countFavorites]);

        return back();
    }
}

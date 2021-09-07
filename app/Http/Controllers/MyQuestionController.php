<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class MyQuestionController extends Controller
{
    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        if (isset($_GET['query']) && strlen($_GET['query']) > 1) {
            $search_text = $request->input('query');
            $questions = Question::with("user")->where('user_id', $user_id)
                ->where('title', 'LIKE', '%' . $search_text . '%')
                ->latest()->paginate(Config::get('app.paginate_number'));

            return view('my_questions.index', compact('questions'));
        } else {
            $questions = Question::with("user")->where('user_id', $user_id)->latest()
                ->paginate(Config::get('app.paginate_number'));

            return view('my_questions.index', compact('questions'));
        }
    }
}

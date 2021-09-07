<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class MyAnswerController extends Controller
{
    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        if (isset($_GET['query']) && strlen($_GET['query']) > 1) {
            $search_text = $request->input('query');
            $answers = Answer::with("user")->where('user_id', $user_id)
                ->where('content', 'LIKE', '%' . $search_text . '%')
                ->latest()->paginate(Config::get('app.paginate_number'));

            return view('my_answers.index', compact('answers'));
        } else {
            $answers = Answer::with("user")->where('user_id', $user_id)->latest()
                ->paginate(Config::get('app.paginate_number'));

            return view('my_answers.index', compact('answers'));
        }
    }
}

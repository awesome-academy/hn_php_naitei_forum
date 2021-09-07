<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteQuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function voteQuestion(Request $request)
    {
        $questionToVote = Question::find($request->question_id);
        if ($request->vote > 0) {
            $questionToVote->votes()->updateOrCreate(
                [
                    'voteable_id' => $request->question_id,
                    'voteable_type' => "App\Models\Question",
                    'user_id' => Auth::id()
                ],
                ['up_vote' => 1, 'down_vote' => 0],
            );
        } else {
            $questionToVote->votes()->updateOrCreate(
                [
                    'voteable_id' => $request->question_id,
                    'voteable_type' => "App\Models\Question",
                    'user_id' => Auth::id()
                ],
                ['up_vote' => 0, 'down_vote' => 1],
            );
        }
        $up = 0;
        $down = 0;
        foreach ($questionToVote->votes as $value) {
            $up += $value->up_vote;
            $down += $value->down_vote;
        }
        $questionToVote->update([
            'up_vote' => $up,
            'down_vote' => $down,
        ]);

        return back();
    }
}

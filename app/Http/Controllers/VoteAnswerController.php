<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteAnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function voteAnswer(Request $request)
    {
        $answerToVote = Answer::find($request->answer_id);
        if ($request->vote > 0) {
            $answerToVote->votes()->updateOrCreate(
                [
                    'voteable_id' => $request->answer_id,
                    'voteable_type' => "App\Models\Answer",
                    'user_id' => Auth::id()
                ],
                ['up_vote' => 1, 'down_vote' => 0],
            );
        } else {
            $answerToVote->votes()->updateOrCreate(
                [
                    'voteable_id' => $request->answer_id,
                    'voteable_type' => "App\Models\Answer",
                    'user_id' => Auth::id()
                ],
                ['up_vote' => 0, 'down_vote' => 1],
            );
        }
        $up = 0;
        $down = 0;
        foreach ($answerToVote->votes as $value) {
            $up += $value->up_vote;
            $down += $value->down_vote;
        }
        $votes_count = $up - $down;
        Answer::where('id', $request->answer_id)->update(['votes_count' => $votes_count]);

        return back();
    }
}

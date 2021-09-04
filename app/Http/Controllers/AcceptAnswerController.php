<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AcceptAnswerController extends Controller
{
    public function __invoke(Answer $answer)
    {
        if (Gate::denies('accept', $answer)) {
            abort(403, "Access denied");
        }
        $answer->question->acceptBestAnswer($answer);

        return back();
    }
}

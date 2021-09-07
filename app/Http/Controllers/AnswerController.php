<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerRequest;
use App\Models\Answer;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnswerRequest $request)
    {
        $request->validated();
        $userId = Auth::id();

        $dataInsert = [
            'content' => $request->content,
            'question_id' => $request->questionId,
            'user_id' => $userId,
            'created_at' => Carbon::now(),
        ];
        DB::table('answers')->insert($dataInsert);
        $question = Question::find($request->questionId);
        $question->increment('answers');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        if (Gate::denies('update-answer', $answer)) {
            abort(403, "Access denied");
        }
        $answerToUpdate = Answer::find($answer->id);

        return view('answers._update', compact('answerToUpdate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnswerRequest $request, Answer $answer)
    {
        if (Gate::denies('update-answer', $answer)) {
            abort(403, "Access denied");
        }
        $data = $request->validated();
        $answerToUpdate = Answer::find($answer->id);
        $answerToUpdate->update(['content' => $data['content']]);

        return redirect()->route('questions.show', $answer->question_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();
        $question = Question::find($answer->question_id);
        $question->update(['answers' => ($question->answers - 1)]);

        return back();
    }
}

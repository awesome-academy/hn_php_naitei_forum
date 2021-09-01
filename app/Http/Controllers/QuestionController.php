<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\QuestionRequest;
use App\Models\Models\User;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::with("user")->latest()->paginate(Config::get('paginate_number'));

        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $question = new Question();

        return view('questions.create', compact('tags', 'question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        $dataQuestion = [
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user()->id,
            'slug' => Str::slug($request->title, '-'),
        ];

        $newQuestion = Question::create($dataQuestion);
        $tagQuestionArray = [];
        foreach ($request->tags as $tag) {
            array_push($tagQuestionArray, [
                'tag_id' => $tag,
                'question_id' => $newQuestion->id,
            ]);
        }
        DB::table('tag_question')->insert($tagQuestionArray);

        return redirect()->route('questions.index')->with('success', __('question.add-success'));
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
    public function edit(Question $question)
    {
        if (Gate::denies('update-question', $question)) {
            abort(403, "Access denied");
        }
        $tags = Question::find($question->id)->tags()->get();

        return view("questions.edit", compact('question', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, Question $question)
    {
        if (Gate::denies('update-question', $question)) {
            abort(403, "Access denied");
        }
        $data = $request->validated();
        $data['id'] = $question->id;
        Question::where('id', $data["id"])->update($data);

        return redirect('/questions')->with('success', __('question.update-success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        if (Gate::denies('delete-question', $question)) {
            abort(403, "Access denied");
        }
        $question->delete();

        return redirect('/questions')->with('success', __('question.delete-success'));
    }
}

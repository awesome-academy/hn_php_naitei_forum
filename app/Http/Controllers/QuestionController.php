<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\QuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
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
        $questions = Question::with("user")->latest()->paginate(Config::get('app.paginate_number'));

        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all()->pluck('title');

        return view('questions.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        $request->validated();
        $listTags = explode(", ", $request->tags);
        $listTagsId = [];
        $tagsIdExist = DB::table('tags')->whereIn('title', $listTags)->get()->toArray();
        $tagsIdExistConverted = [];
        foreach ($tagsIdExist as $value) {
            array_push($tagsIdExistConverted, [
                'id' => $value->id,
                'title' => $value->title,
            ]);
        }
        foreach ($listTags as $key => $tag) {
            foreach ($tagsIdExistConverted as $tagExist) {
                if (strcmp($tag, $tagExist['title']) == 0) {
                    array_push($listTagsId, $tagExist['id']);
                    unset($listTags[$key]);
                }
            }
        }
        foreach ($listTags as $tag) {
            $newTag = Tag::create(['title' => $tag]);
            array_push($listTagsId, $newTag->id);
        }
        $dataQuestion = [
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user()->id,
            'slug' => Str::slug($request->title, '-'),
        ];
        $newQuestion = Question::create($dataQuestion);
        $tagQuestionArray = [];
        foreach ($listTagsId as $tag) {
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
        $question = Question::find($id);
        $question->increment('views');
        $answers = $question->answers()->get();

        return view('questions.show', compact('question', 'answers'));
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
        $allTags = Tag::all()->pluck('title');
        $tags = Question::find($question->id)->tags()->pluck('title');
        $valueInput = implode(",", $tags->all());

        return view('questions.edit', compact('question', 'valueInput', 'allTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        if (Gate::denies('update-question', $question)) {
            abort(403, "Access denied");
        }
        $data = $request->validated();
        $request->validated();
        $listTags = explode(", ", $request->tags);
        $listTagsId = [];
        $tagsIdExist = DB::table('tags')->whereIn('title', $listTags)->get()->toArray();
        $tagsIdExistConverted = [];
        foreach ($tagsIdExist as $value) {
            array_push($tagsIdExistConverted, [
                'id' => $value->id,
                'title' => $value->title,
            ]);
        }
        foreach ($listTags as $key => $tag) {
            foreach ($tagsIdExistConverted as $tagExist) {
                if (strcmp($tag, $tagExist['title']) == 0) {
                    array_push($listTagsId, $tagExist['id']);
                    unset($listTags[$key]);
                }
            }
        }
        foreach ($listTags as $tag) {
            $newTag = Tag::create(['title' => $tag]);
            array_push($listTagsId, $newTag->id);
        }
        $dataQuestion = [
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user()->id,
            'slug' => Str::slug($request->title, '-'),
        ];
        $data['id'] = $question->id;
        Question::where('id', $data["id"])->update($dataQuestion);
        $tagQuestionArray = [];
        foreach ($listTagsId as $tag) {
            array_push($tagQuestionArray, [
                'tag_id' => $tag,
                'question_id' => $data["id"],
            ]);
        }
        DB::table('tag_question')->where('question_id', $data["id"])->delete();
        DB::table('tag_question')->insert($tagQuestionArray);

        return redirect()->route('questions.index')->with('success', __('question.update-success'));
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

        return redirect()->route('questions.index')->with('success', __('question.delete-success'));
    }
}

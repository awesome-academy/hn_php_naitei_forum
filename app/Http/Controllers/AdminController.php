<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Gate::allows('is-admin')) {
            return view('admin.index');
        }

        return route('home');
    }

    public function managerUser()
    {
        $users = User::with("role")->where('role_id', Config::get('app.user_id'))
            ->latest()->paginate(Config::get('app.paginate_number'));

        return view('admin.user_manager', compact('users'));
    }

    public function managerQuestion()
    {
        $questions = Question::with("user")->latest()->paginate(Config::get('app.paginate_number'));

        return view('admin.question_manager', compact('questions'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteQuestion($id)
    {
        Question::find($id)->delete();

        return redirect(route('question-management'))
            ->with('message', trans('admin.delete_question_success'));
    }

    public function activeQuestion(Request $request)
    {
        if (isset($request->id)) {
            Question::where('id', $request->id)->update([
                'active' => Config::get('app.question_active')
            ]);

            return redirect(route('question-management'))
                ->with('message', trans('admin.active_question_success'));
        } else {
            abort(403);
        }
    }

    public function inactiveQuestion(Request $request)
    {
        if (isset($request->id)) {
            Question::where('id', $request->id)->update([
                'active' => Config::get('app.question_inactive')
            ]);

            return redirect(route('question-management'))
                ->with('message', trans('admin.inactive_question_success'));
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteUser($id)
    {
        User::find($id)->delete();

        return redirect(route('user-management'))
            ->with('message', trans('admin.delete_user_success'));
    }

    public function activeUser(Request $request)
    {
        if (isset($request->id)) {
            User::where('id', $request->id)->update([
                'status' => Config::get('app.user_active')
            ]);

            return redirect(route('user-management'))
                ->with('message', trans('admin.active_user_success'));
        } else {
            abort(403);
        }
    }

    public function inactiveUser(Request $request)
    {
        if (isset($request->id)) {
            User::where('id', $request->id)->update([
                'status' => Config::get('app.user_inactive')
            ]);

            return redirect(route('user-management'))
                ->with('message', trans('admin.inactive_user_success'));
        } else {
            abort(403);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

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
        return view('admin.user_manager');
    }

    public function managerQuestion()
    {
        return view('admin.question_manager');
    }
}

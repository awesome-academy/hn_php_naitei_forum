<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckInforRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt as FacadeCrypt;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function changeInformation(CheckInforRequest $request)
    {
        if ($request->old_password) {
            if (!Hash::check($request->old_password, Auth::user()->password)) {
                return abort(403);
            }
        }
        User::where('id', Auth::user()->id)
            ->update([
                'name' => $request->username,
            ]);

        return redirect(route('profile'));
    }
}

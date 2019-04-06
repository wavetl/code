<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
    public function center()
    {
        $user = Auth::user();
        return view('user/center',compact('user'));
    }

    public function info(Request $request)
    {
        $user = app('user')->find($request->route('id'));
        return view('user/info', compact('user'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
    public function info(Request $request)
    {
        $user = app('App\User')->find($request->route('id'));
        return view('user/info', compact('user'));
    }
}

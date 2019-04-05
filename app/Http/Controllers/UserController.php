<?php

namespace App\Http\Controllers;

use App\Http\Requests\PMRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function info(Request $request)
    {
        $user = app('App\User')->find($request->route('id'));
        return view('user/info',compact('user'));
    }

    public function pm(Request $request)
    {
        $receiver = app('App\User')->find($request->route('id'));
        return view('/user/pm',compact('receiver'));
    }

    public function pm_send(PMRequest $request)
    {
        $validated = $request->validated();

        $pm = app('App\PM');
        $pm->receiver_id = $validated['receiver_id'];
        $pm->content = $validated['content'];
        $pm->save();

        return ['id' => $pm->id];
    }
}

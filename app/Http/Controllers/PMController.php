<?php

namespace App\Http\Controllers;

use App\Http\Requests\PMRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PMController extends BaseController
{
    public function show(Request $request)
    {
        $pm = app('App\PM')->find($request->route('id'));
        if ($pm->receiver_id !== Auth()->id()) {
            return redirect()->back()->withErrors(['您没有权限查看这条私信']);
        }
        if (!$pm->is_read) {
            $pm->is_read = true;
            $pm->read_at = date('Y-m-d H:i:s');
            $pm->save();

            $this->resetViewData();
        }
        return view('pm/show', compact('pm'));

    }

    public function form(Request $request)
    {
        $receiver = app('App\User')->find($request->route('id'));
        return view('pm/send', compact('receiver'));
    }

    public function send(PMRequest $request)
    {
        $validated = $request->validated();

        $pm = app('App\PM');
        $pm->receiver_id = $validated['receiver_id'];
        $pm->sender_id = Auth::id();
        $pm->content = $validated['content'];
        $pm->save();

        return ['id' => $pm->id];
    }

    public function inbox()
    {
        $pm_list = app('App\PM')->where('receiver_id', Auth()->id())->orderBy('created_at', 'DESC')->get();
        return view('pm/inbox', compact('pm_list'));
    }
}

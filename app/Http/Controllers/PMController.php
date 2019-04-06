<?php

namespace App\Http\Controllers;

use App\Http\Requests\PMRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class PMController extends BaseController
{
    public function show(Request $request)
    {
        $pm = app('pm')->where(['id' => $request->route('id'), 'is_deleted' => false])->first();
        if (!$pm) {
            return redirect(route('pm_inbox'))->with('error', '这条私信已被删除');
        }
        if ($pm->receiver_id !== Auth()->id()) {
            return redirect(route('pm_inbox'))->with('error', '您没有权限查看这条私信');
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
        $receiver = app('user')->find($request->route('id'));
        return view('pm/send', compact('receiver'));
    }

    public function send(PMRequest $request)
    {
        $validated = $request->validated();

        if ($validated['receiver_id'] == Auth::id()) {
            return Response::json(['errors' => ['content' => ['您无法给自己发送私信']]], 422);
        }

        $pm = app('pm')->make();
        $pm->receiver_id = $validated['receiver_id'];
        $pm->sender_id = Auth::id();
        $pm->content = $validated['content'];
        $pm->save();

        return ['id' => $pm->id];
    }

    public function delete(Request $request)
    {
        $pm = app('pm')->find($request->input('id'));
        $pm->is_deleted = true;
        return ['deleted' => $pm->save()];
    }

    public function inbox()
    {
        $pm_list = app('pm')->where(['receiver_id' => Auth()->id(), 'is_deleted' => false])->orderBy('created_at', 'DESC')->get();
        return view('pm/inbox', compact('pm_list'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateInfoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    public function center()
    {
        $user = Auth::user();
        return view('user/center', compact('user'));
    }

    public function info(Request $request)
    {
        $user = app('user')->find($request->route('id'));
        return view('user/info', compact('user'));
    }

    public function edit_info(Request $request)
    {
        $user = app('auth')->user();
        return view('auth/edit_info', compact('user'));
    }

    public function update_info(UpdateInfoRequest $request)
    {
        $validated = $request->validated();
        $user = app('auth')->user();
        $exists = app('user')->where('name', $validated['name'])->first();
        if ($exists && $exists->id !== $user->id) {
            return redirect()->back()->with('error', '该昵称已被使用');
        }

        $user->password = Hash::make($validated['password']);
        $user->save();

        return redirect()->back()->with('success', '个人信息修改成功');
    }
}

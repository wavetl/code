<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\CodeRequest;

use Overtrue\Pinyin\Pinyin;

class CodeController extends BaseController
{
    public function index()
    {
        return view('home');
    }

    public function share()
    {
        return view('code/share');
    }

    public function save(CodeRequest $request)
    {
        $validated = $request->validated();

        $code = app('App\Code');
        $code->subject = $validated['subject'];
        $code->code = $validated['code'];
        $code->user_id = Auth::id();
        $code->language = $validated['language'];
        $code->slug = app(Pinyin::class)->permalink($validated['subject']);
        $code->save();
        return ['code_id' => $code->id];
    }

    public function view(Request $request)
    {
        $code = app('App\Code')::find($request->route('id'));

        return view('code/view', compact('code'));
    }

    public function find(Request $request)
    {
        $code = app('App\Code')::with(['user'])->find($request->input('code_id'));
        return $code;
    }
}

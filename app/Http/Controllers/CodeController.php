<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\CodeRequest;
use App\Code;
use App\Jobs\CodeAddHitJob;

use Overtrue\Pinyin\Pinyin;

class CodeController extends BaseController
{
    public function index(Request $request)
    {
        $language = $request->route('language');
        return view('home', compact('language'));
    }

    public function share()
    {
        return view('code/share');
    }

    public function edit(Request $request)
    {
        $code = app('App\Code')::find($request->route('id'));
        return view('code/edit', compact('code'));
    }

    public function save(CodeRequest $request)
    {
        $validated = $request->validated();

        if ($request->input('id')) {
            $code = app('App\Code')::find($request->input('id'));
            $code->subject = $validated['subject'];
            $code->code = $validated['code'];
            $code->language = $validated['language'];
            $code->slug = app(Pinyin::class)->permalink($validated['subject']);
            $code->save();
        } else {
            $code = new Code();
            $code->subject = $validated['subject'];
            $code->code = $validated['code'];
            $code->user_id = Auth::id();
            $code->language = $validated['language'];
            $code->slug = app(Pinyin::class)->permalink($validated['subject']);
            $code->save();

            $user = Auth::user();
            $user->code_count += 1;
            $user->save();

            Artisan::call('view:clear');
        }
        return ['code_id' => $code->id];
    }

    public function view(Request $request)
    {
        $code = app('App\Code')::find($request->route('id'));

        app(CodeAddHitJob::class)::dispatch($code);
        return view('code/view', compact('code'));
    }

    public function find(Request $request)
    {
        $code = app('App\Code')::with(['user'])->find($request->input('code_id'));
        return $code;
    }

    public function delete(Request $request)
    {
        $code = app('App\Code')::find($request->input('id'));

        if ($code->user_id !== Auth::id()) {
            return Response()->json(['error' => '权限不足'],403);
        }

        $data = ['deleted' => $code->delete()];

        if ($data['deleted']) {

            $user = app('App\User')::find($code->user_id);
            $user->code_count -= 1;
            $user->save();

            Artisan::call('view:clear');
        }

        return $data;
    }
}

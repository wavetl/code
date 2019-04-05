@extends('layouts.code')
@section('main')
    <div class="card">
        <div class="card-header">
            <span><i class="fa fa-comment"></i> {{ __('pm.PM') }}</span>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>{{ __('pm.receiver_name') }}</label>
                <span class="ml-3">{{ $receiver->name }}</span>
            </div>
            <div class="form-group">
                <textarea class="form-control" ref="content" rows="4" name="content" placeholder="输入私信内容"></textarea>
            </div>
            <div class="form-group text-center">
                <button class="btn btn-primary" @click="sendPM">{{ __('pm.send') }}</button>
                <a class="btn btn-outline-secondary" href="{{ route('home') }}">{{ __('pm.cancel') }}</a>
                <input type="hidden" ref="receiver_id" name="receiver_id" value="{{ $receiver->id }}" />
            </div>
        </div>
    </div>
@endsection
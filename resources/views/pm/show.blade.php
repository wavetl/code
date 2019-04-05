@extends('layouts.code')
@section('main')
    <div class="card">
        <div class="card-header">
            <span><i class="fa fa-comment"></i> {{ __('pm.View') }}</span>
        </div>
        <div class="card-body">
            <div class="form-group">
                <a href="{{ route('user_info',['id' => $pm->sender_id]) }}">{{ $pm->sender->name }}</a> 发送于 {{ $pm->created_at->diffForHumans() }}
            </div>
            <div class="form-group">
                {!! nl2br($pm->content) !!}
            </div>
            <div class="form-group text-center">
                <a class="btn btn-outline-primary" href="{{ route('pm_inbox') }}">{{ __('pm.InBox') }}</a>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.code')
@section('main')
    <div class="card mb-3">
        <div class="card-header">
            <span><i class="fa fa-comment"></i> {{ __('pm.View') }}</span>
            <div class="dropdown float-right">
                <button class="btn btn-sm btn-outline-primary" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-ellipsis-h"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#" @click="deletePM({{ $pm->id }})"><span
                                data-feather="x"></span><i class="fa fa-times"></i>  {{ __('messages.Delete') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <a href="{{ route('user_info',['id' => $pm->sender_id]) }}">{{ $pm->sender->name }}</a>
                发送于 {{ $pm->created_at->diffForHumans() }}
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
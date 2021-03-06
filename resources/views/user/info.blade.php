@extends('layouts.code')
@section('main')
    <div class="card mb-3">
        <div class="card-header">
            <strong><i class="fa fa-user"></i> {{ __('userinfo.UserInfo',['name' => $user->name]) }}
            </strong>
        </div>
        <div class=" card-body">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <td style="width: 50%;"><i class="fa fa-user"></i> {{ __('userinfo.name') }}</td>
                    <td style="width: 50%;">{{ $user->name }}</td>
                </tr>
                <tr>
                    <td><i class="fa fa-clock"></i> {{ __('userinfo.created_at') }}</td>
                    <td>{{ $user->created_at->diffForHumans() }}</td>
                </tr>
                <tr>
                    <td><i class="fa fa-code"></i> {{ __('userinfo.code_count') }}</td>
                    <td>{{ $user->code_count }}</td>
                </tr>
                @if($user->logged_at)
                    <tr>
                        <td><i class="fa fa-clock"></i> {{ __('userinfo.logged_at') }}</td>
                        <td>{{ $user->logged_at }}</td>
                    </tr>
                @endif
                @if(!Auth()->guest() && $user->id !== Auth()->id())
                    <tr>
                        <td>
                        </td>
                        <td>
                            <a href="{{ route('pm_form',['id' => $user->id]) }}"
                               class="btn btn-outline-primary"><i
                                        class="fa fa-paper-plane"></i> {{ __('userinfo.send_message') }}</a>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header"><strong><i
                        class="fa fa-code"></i> {{ __('userinfo.UserCodeList',['name' => $user->name]) }}</strong>
        </div>
        <div class="card-body my-code-list">
            @foreach($code_list as $code)
                @component('code.code',['code' => $code])
                @endcomponent
            @endforeach
            {{ $code_list->links() }}
        </div>
    </div>
@endsection
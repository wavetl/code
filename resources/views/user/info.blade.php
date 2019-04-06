@extends('layouts.code')
@section('main')
    <div class="card">
        <div class="card-header">
            <strong ><i class="fa fa-user"></i> {{ __('userinfo.UserInfo',['name' => $user->name]) }}
            </strong>
        </div>
        <div class=" card-body">
            <table>
                <thead>
                <th class="text-right" style="width: 50%"></th>
                <th style="width: 50%"></th>
                </thead>
                <tbody>
                <tr>
                    <td class="text-left"><i class="fa fa-user"></i> {{ __('userinfo.name') }}</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td class="text-left pt-3"><i class="fa fa-clock"></i> {{ __('userinfo.created_at') }}</td>
                    <td>{{ $user->created_at->diffForHumans() }}</td>
                </tr>
                <tr>
                    <td class="text-left pt-3"><i class="fa fa-code"></i> {{ __('userinfo.code_count') }}</td>
                    <td>{{ $user->code_count }}</td>
                </tr>
                @if($user->logged_at)
                    <tr>
                        <td class="text-left pt-3"><i class="fa fa-clock"></i> {{ __('userinfo.logged_at') }}</td>
                        <td>{{ $user->logged_at }}</td>
                    </tr>
                @endif
                <tr>
                    <td></td>
                    <td class="text-right pt-3">
                        <a href="{{ route('pm_form',['id' => $user->id]) }}"
                           class="btn btn-outline-success mr-1">{{ __('userinfo.follow') }}</a>
                        <a href="{{ route('pm_form',['id' => $user->id]) }}"
                           class="btn btn-outline-primary"><i class="fa fa-paper-plane"></i> {{ __('userinfo.send_message') }}</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
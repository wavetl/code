@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if (Session::has('info'))
                    <div class="alert alert-info alert-dismissible fade show"
                         role="alert">{{ Session::get('info') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show"
                         role="alert">{{ Session::get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show"
                         role="alert">{{ Session::get('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card border-info mb-3">
                    <div class="card-header bg-info"><strong
                                class="text-white"><i class="fa fa-code"></i> {{ __('usercenter.MyCodeList') }}</strong>
                    </div>
                    <div class="card-body my-code-list">
                        <code_list :user_id="'{{ $user->id }}'" :is_author="true" />
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-secondary">
                    <div class="card-header bg-secondary"><strong
                                class="text-white"><i class="fa fa-user"></i> {{ __('usercenter.MyProfile') }}</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td><i class="fa fa-user"></i> {{ __('userinfo.name') }}</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-user-plus"></i> {{ __('userinfo.created_at') }}</td>
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
                            </tbody>
                        </table>
                        <a class="btn btn-outline-secondary" style="width: 100%;"
                           href=""><i
                                    class="fa fa-lock"></i> {{ __('usercenter.change_profile') }}</a>
                        <a class="btn btn-outline-secondary mt-1" style="width: 100%;"
                           href="" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                    class="fa fa-sign-out-alt"></i> {{ __('usercenter.Logout') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
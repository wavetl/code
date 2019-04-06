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
                @yield('main')
            </div>
            <div class="col-md-4">
                <div class="card border-success mb-3">
                    <div class="card-header bg-success"><strong
                                class="text-white"><i class="fa fa-user"></i> {{ __('usercenter.MyProfile') }}</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td><i class="fa fa-user"></i> {{ __('userinfo.name') }}</td>
                                <td>{{ $my_info->name }}</td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-user-plus"></i> {{ __('userinfo.created_at') }}</td>
                                <td>{{ $my_info->created_at->diffForHumans() }}</td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-code"></i> {{ __('userinfo.code_count') }}</td>
                                <td>{{ $my_info->code_count }}</td>
                            </tr>
                            @if($my_info->logged_at)
                                <tr>
                                    <td><i class="fa fa-clock"></i> {{ __('userinfo.logged_at') }}</td>
                                    <td>{{ $my_info->logged_at }}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <a class="btn btn-outline-success" style="width: 100%;"
                           href="{{ route('user_edit_info') }}"><i
                                    class="fa fa-user-edit"></i> {{ __('usercenter.change_profile') }}</a>
                        <a class="btn btn-outline-success mt-1" style="width: 100%;"
                           href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                    class="fa fa-sign-out-alt"></i> {{ __('usercenter.Logout') }}</a>
                    </div>
                </div>
                <div class="card border-info mb-3">
                    <div class="card-header bg-info">
                        <strong class="text-white">{{ __('pm.InBox') }}</strong>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
@endsection
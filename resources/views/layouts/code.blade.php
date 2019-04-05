@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @yield('main')
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('code_share') }}" class="btn btn-outline-success btn-lg" style="width:100%;">分享我的代码</a>
                    </div>
                </div>
                <div class="card mt-3 border-success">
                    <div class="card-header bg-success"><strong class="text-white">代码分享排行</strong></div>
                    <div class="card-body pb-0">
                        @top_share_users
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
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
                        <a href="{{ route('code_share') }}" class="btn btn-outline-success btn-lg"
                           style="width:100%;"><i class="fa fa-code"></i> 分享我的代码</a>
                    </div>
                </div>

                <div class="card mt-3 border-success">
                    <div class="card-header bg-success"><strong class="text-white"><i class="fa fa-list-ol"></i> 用户分享排行</strong></div>
                    <div class="card-body pb-0">
                        @top_share_users
                    </div>
                </div>

                <div class="card mt-3 border-secondary">
                    <div class="card-header bg-secondary"><strong class="text-white"><i class="fa fa-cogs"></i> 统计信息</strong></div>
                    <div class="card-body pb-0">
                        <ul class="list-unstyled">
                            <li><i class="fa fa-user mr-2"></i> 注册用户数：{{ cache()->get('total_users',0) }}</li>
                            <li><i class="fa fa-code mr-1"></i> 分享代码数：{{ cache()->get('total_shares',0) }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
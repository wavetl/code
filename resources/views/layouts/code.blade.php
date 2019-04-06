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
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('code_share') }}" class="btn btn-outline-success btn-lg"
                           style="width:100%;"><i class="fa fa-code"></i> 分享我的代码</a>
                    </div>
                </div>

                <div class="card mt-3 border-success">
                    <div class="card-header bg-success"><strong class="text-white">代码分享排行</strong></div>
                    <div class="card-body pb-0">
                        @top_share_users
                    </div>
                </div>

                <div class="card mt-3 border-primary">
                    <div class="card-header bg-primary"><strong class="text-white">代码分类</strong></div>
                    <div class="card-body ">
                        @if($language === 'php')
                            <a href="{{ route('home') }}" class="btn btn-info"><i
                                        class="fab fa-php"></i> PHP</a>
                        @else
                            <a href="{{ route('code_language',['language' => 'php']) }}" class="btn btn-outline-info"><i
                                        class="fab fa-php"></i> PHP</a>
                        @endif

                        @if($language === 'js')
                            <a href="{{ route('home') }}" class="btn btn-success"><i
                                        class="fab fa-js"></i> JavaScript</a>
                        @else
                            <a href="{{ route('code_language',['language' => 'js']) }}" class="btn btn-outline-success"><i
                                        class="fab fa-js"></i> JavaScript</a>
                        @endif
                        @if($language === 'python')
                            <a href="{{ route('home') }}" class="btn btn-danger"><i
                                        class="fab fa-python"></i> Python</a>
                        @else
                            <a href="{{ route('code_language',['language' => 'python']) }}" class="btn btn-outline-danger"><i
                                        class="fab fa-python"></i> Python</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
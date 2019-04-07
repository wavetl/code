@extends('layouts.code')

@section('main')
    <div class="card mb-3">
        <div class="card-body">
            @if($language != '')
                <a href="{{ route('home') }}" class="btn btn-outline-secondary"><i
                            class="fa fa-braille"></i> 全部</a>
            @else
                <a href="{{ route('home') }}" class="btn btn-secondary"><i
                            class="fa fa-braille"></i> 全部</a>
            @endif
            @if($language === 'php')
                <a href="{{ route('code_language',['language' => 'php']) }}" class="btn btn-info"><i
                            class="fab fa-php"></i> PHP</a>
            @else
                <a href="{{ route('code_language',['language' => 'php']) }}" class="btn btn-outline-info"><i
                            class="fab fa-php"></i> PHP</a>
            @endif

            @if($language === 'js')
                <a href="{{ route('code_language',['language' => 'js']) }}" class="btn btn-success"><i
                            class="fab fa-js"></i> JavaScript</a>
            @else
                <a href="{{ route('code_language',['language' => 'js']) }}" class="btn btn-outline-success"><i
                            class="fab fa-js"></i> JavaScript</a>
            @endif
            @if($language === 'python')
                <a href="{{ route('code_language',['language' => 'python']) }}" class="btn btn-danger"><i
                            class="fab fa-python"></i> Python</a>
            @else
                <a href="{{ route('code_language',['language' => 'python']) }}"
                   class="btn btn-outline-danger"><i
                            class="fab fa-python"></i> Python</a>
            @endif
            @if($language === 'css')
                <a href="{{ route('code_language',['language' => 'css']) }}" class="btn btn-info"><i
                            class="fab fa-css"></i> CSS</a>
            @else
                <a href="{{ route('code_language',['language' => 'css']) }}"
                   class="btn btn-outline-info"><i
                            class="fab fa-css"></i> CSS</a>
            @endif
        </div>
    </div>
    @foreach($code_list as $code)
        @component('code.code',['code' => $code])
        @endcomponent
    @endforeach
    {{ $code_list->links() }}
@endsection
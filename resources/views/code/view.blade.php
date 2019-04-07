@extends('layouts.code')

@section('main')
    @component('code.code',['code' => $code])

    @endcomponent
@endsection
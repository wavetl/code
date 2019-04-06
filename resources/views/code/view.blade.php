@extends('layouts.code')

@section('main')
    <code_list :code_id="{{  $code->id }}" :is_author="{{ (int)($code->user_id === Auth::id()) }}" />
@endsection
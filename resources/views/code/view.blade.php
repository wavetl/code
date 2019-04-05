@extends('layouts.code')

@section('main')
    <code_list :code_id="<?php echo $code->id; ?>"/>
@endsection
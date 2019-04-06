@extends('layouts.code')

@section('main')
<code_list :language="'{{ $language }}'" />
@endsection
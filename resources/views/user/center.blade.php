@extends('layouts.user')

@section('main')
    <div class="card border-info mb-3">
        <div class="card-header bg-info"><strong
                    class="text-white"><i class="fa fa-code"></i> {{ __('usercenter.MyCodeList') }}</strong>
        </div>
        <div class="card-body my-code-list">
            <code_list :user_id="'{{ $user->id }}'" :is_author="true"/>
        </div>
    </div>
@endsection
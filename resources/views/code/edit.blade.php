@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><i class="fa fa-code"></i> {{ __('code.Edit') }}</div>

                    <div class="card-body">
                        <code_editor :code_id="'{{ $code->id }}'" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

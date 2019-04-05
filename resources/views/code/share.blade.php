@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><i class="fa fa-code"></i> {{ __('code.Share') }}</div>

                    <div class="card-body">
                        <code_editor />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

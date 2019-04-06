@extends('layouts.user')

@section('main')
    <div class="card mb-3">
        <div class="card-header"><i class="fa fa-user-edit"></i> {{ __('auth.EditInfo') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('user_update_info') }}">
                @csrf

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('login.email') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" disabled="disabled"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                               value="{{ $user->email }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('auth.nick_name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                               name="name" value="{{ $user->name }}" required>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif

                    </div>
                </div>

                <div class="form-group row">
                    <label for="password"
                           class="col-md-4 col-form-label text-md-right">{{ __('login.password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password"
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                               required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password_confirmation"
                           class="col-md-4 col-form-label text-md-right">{{ __('auth.password_confirmation') }}</label>

                    <div class="col-md-6">
                        <input id="password_confirmation" type="password"
                               class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                               name="password_confirmation" required>

                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            {{ __('auth.UpdateInfo') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

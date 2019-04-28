@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="container d-flex flex-column justify-content-center">
                <h1 class="text-uppercase text-center text-primary display-4">{{ __('Register') }}</h1>
                <div class="row social-login text-center justify-content-around px-5 pt-5">
                    <div class="col rounded-circle shadow-sm flex-grow-0 d-flex justify-content-center align-items-center px-2 py-2 text-primary"><i class="fab fa-github fa-2x"></i></div>
                    <div class="col rounded-circle shadow-sm flex-grow-0 d-flex justify-content-center align-items-center px-2 py-2 text-primary"><i class="fab fa-google fa-2x"></i></div>
                    <div class="col rounded-circle shadow-sm flex-grow-0 d-flex justify-content-center align-items-center px-2 py-2 text-primary"><i class="fab fa-twitter fa-2x"></i></div>
                </div>
                <div class=" text-center or-divider mt-4">OR</div>
                <form method="POST" action="{{ route('register') }}" class="mt-4">
                    @csrf

                    <div class="form-group py-1 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right font-weight-normal">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control  rounded-pill bg-transparent{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group py-1 row">
                                <label for="email" class="col-md-4 col-form-label text-md-right font-weight-normal">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control rounded-pill bg-transparent{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>




                            <div class="form-group py-1 row">
                                <label for="password" class="col-md-4 col-form-label text-md-right font-weight-normal">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control rounded-pill bg-transparent{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group py-1 row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right font-weight-normal">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control rounded-pill bg-transparent" name="password_confirmation" required>
                                </div>
                            </div>
                    <div class="form-group py-1 row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

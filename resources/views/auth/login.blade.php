@extends('layouts.app')

@section('content')
    <div class="container d-flex flex-column justify-content-center">
        <h1 class="text-uppercase text-center text-primary display-4">{{ __('Login') }}</h1>
        @include('partials.social_login')
        <div class=" text-center or-divider mt-4">OR</div>
        <form method="POST" action="{{ route('login') }}" class="mt-4">
            @csrf

            <div class="form-group py-1 row">
                <label for="email"
                       class="col-md-4 col-form-label text-md-right font-weight-normal">{{ __('Email') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email"
                           class="form-control rounded-pill bg-transparent{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group py-1 row">
                <label for="password"
                       class="col-md-4 col-form-label text-md-right font-weight-normal">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password"
                           class="form-control rounded-pill bg-transparent{{ $errors->has('password') ? ' is-invalid' : '' }}"
                           name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group py-1 row">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember"
                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group py-1 row mb-0 ">
                <div class="col-md-6 offset-md-4 d-flex justify-content-between">
                    <button type="submit"
                            class="btn btn-primary rounded-pill  py-1 px-4"
                            dusk="login-form-button"
                    >
                        {{ __('Login') }}
                    </button>

                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
@endsection

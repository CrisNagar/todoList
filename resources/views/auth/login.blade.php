@extends('layouts.appWithoutNav')

@section('style')
    <style>
        #app {
            display: flex;
            align-items: center;
            padding-top: 2.5%;
            padding-bottom: 5%;
        }

        #main {
            width: 100%;
            max-width: 30%;
            padding: 5%;
            margin: auto;
        }


        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px white inset !important;
        }

        .form-check.form-switch {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }

        .form-check-input:checked {
            background-color: var(--bs-success);
            border-color: var(--bs-success);
        }

    </style>
@endsection

@section('content')
    <section id="loginForm">
        <div class="card">
            <div class="d-flex flex-column text-center">
                <i class="fas fa-check-double fa-5x mt-5 mx-auto"></i>
                <h1 class="my-3">
                    <span class="text-warning">TODO</span> LIST
                </h1>
            </div>

            <div class="card-body">
                <form class="text-center" method="POST" action="{{ route('singin') }}">
                    @csrf

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="emailInput"
                            placeholder="email" name="email">
                        <label for="emailInput">{{ __('email') }}</label>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="passwordInput" placeholder="Password" name="password">
                        <label for="passwordInput">{{ __('Password') }}</label>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" role="switch" id="rememberSwitch"
                            {{ old('remember') ? 'checked' : '' }} name="remember">
                        <label class="form-check-label ms-3" for="rememberSwitch">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                    <div class="d-grid gap-2 mb-3">
                        <button type="submit" class="btn btn-outline-secondary" type="button">
                            {{ __('Login') }}
                        </button>
                    </div>


                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </form>
            </div>
        </div>
        <p class="text-muted">
            Haven't you registered yet? <a href="{{ route('register') }}" class="text-reset">Do it here</a>
        </p>
    </section>
@endsection

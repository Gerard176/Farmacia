@extends('layouts.applogin')

@section('content')

<div class="login-box   ">
    <div class="card card-outline card-primary  ">
        <div class="card-header text-center">
            <a href="#" class="h1">Farmacia</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Reiniciar contraseña</p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="input-group mb-3">
                    <input id="email" placeholder="Email" type="email"
                        class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    
                </div>
                
                
                <div class="d-flex justify-content-center ">
                    <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                    </button>
                    
                </div>
            </form>

        </div>
    </div>
</div>

@endsection

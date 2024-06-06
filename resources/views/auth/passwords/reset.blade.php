@extends('layouts.applogin')

@section('content')

<div class="login-box   ">
    <div class="card card-outline card-primary  ">
        <div class="card-header text-center">
            <a href="#" class="h1">Farmacia</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Reiniciar contraseña</p>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="input-group mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror " name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                </div>

                <div class="input-group mb-3">
                    <input id="password" type="password" placeholder="Contraseña" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                   
                </div>

                <div class="input-group mb-3">
                    <input id="password-confirm" type="password" placeholder="Confirmar contraseña" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    
                </div>

                <div class="d-flex justify-content-center">
                    
                        <button type="submit" class="btn btn-primary">
                            {{ __('Reset Password') }}
                        </button>
                    
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

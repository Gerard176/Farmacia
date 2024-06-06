@extends('layouts.applogin')

@section('content')

<div class="login-box   ">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary  ">
        <div class="card-header text-center">
            <a href="#" class="h1">Farmacia</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Inicio de sesion</p>

            <form method="POST" action="{{ route('login') }}">
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
                <div class="input-group mb-3">
                    <input id="password" placeholder="Contraseña" type="password"
                        class="form-control @error('password') is-invalid @enderror" name="password" required
                        autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    
                </div>
                
                <div class="d-flex justify-content-center ">
                    <!-- /.col -->
                    <button type="submit" class="px-5 btn btn-primary ">
                        Ingresar
                    </button>
                    
                    <!-- /.col -->
                </div>
            </form>
            <div class="d-flex justify-content-center">
                <a  href="{{route('register')}}">
                        Registrarse
                            
                </a>
          
            </div>
           
            <p class="d-flex justify-content-center ">
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Olvide mi contraseña') }}
                    </a>
                @endif
            </p>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

@endsection
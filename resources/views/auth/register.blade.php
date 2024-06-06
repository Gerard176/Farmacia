@extends('layouts.appregister')

@section('content')
<div class="container justify-content-center d-flex ">
    <div class="register-box ">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1">Farmacia</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Registro</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="name" type="text" placeholder="Nombre" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
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
                        <input id="password-confirm" type="password" placeholder="Repetir contraseña" class="form-control" name="password_confirmation" required autocomplete="new-password">

                        
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="d-flex justify-content-center ">
                            <button type="submit" class="btn btn-primary btn-block px-5">Registrarse</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <a href="{{route('login')}}" class="text-center d-flex justify-content-center">Ya tengo una cuenta</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
</div>
@endsection

                

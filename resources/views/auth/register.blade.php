<!DOCTYPE html>
@extends('auth.layouts.app')
@section('content')
    <style>
        :root {
        --input-padding-x: 1.5rem;
        --input-padding-y: .75rem;
        }

        body {
        background: #007bff;
        background: linear-gradient(to right, #0062E6, #33AEFF);
        }

        .card-signin {
        border: 0;
        border-radius: 1rem;
        box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
        overflow: hidden;
        }

        .card-signin .card-title {
        margin-bottom: 2rem;
        font-weight: 300;
        font-size: 1.5rem;
        }

        .card-signin .card-img-left {
        
        /* Link to your background image using in the property below! */
        background: scroll center url('/Imagenes/logo_lcc.jpg');
        background-size: 100%;
        }

        .card-signin .card-body {
        padding: 2rem;
        }

        .form-signin {
        width: 100%;
        }

        .form-signin .btn {
        font-size: 80%;
        border-radius: 5rem;
        letter-spacing: .1rem;
        font-weight: bold;
        padding: 1rem;
        transition: all 0.2s;
        }

        .form-label-group {
        position: relative;
        margin-bottom: 1rem;
        }

        .form-label-group input {
        height: auto;
        border-radius: 2rem;
        }

        .form-label-group>input,
        .form-label-group>label {
        padding: var(--input-padding-y) var(--input-padding-x);
        }

        .form-label-group>label {
        position: absolute;
        top: 0;
        left: 0;
        display: block;
        width: 100%;
        margin-bottom: 0;
        /* Override default `<label>` margin */
        line-height: 1.5;
        color: #495057;
        border: 1px solid transparent;
        border-radius: .25rem;
        transition: all .1s ease-in-out;
        }

        .form-label-group input::-webkit-input-placeholder {
        color: transparent;
        }

        .form-label-group input:-ms-input-placeholder {
        color: transparent;
        }

        .form-label-group input::-ms-input-placeholder {
        color: transparent;
        }

        .form-label-group input::-moz-placeholder {
        color: transparent;
        }

        .form-label-group input::placeholder {
        color: transparent;
        }

        .form-label-group input:not(:placeholder-shown) {
        padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
        padding-bottom: calc(var(--input-padding-y) / 3);
        }

        .form-label-group input:not(:placeholder-shown)~label {
        padding-top: calc(var(--input-padding-y) / 3);
        padding-bottom: calc(var(--input-padding-y) / 3);
        font-size: 12px;
        color: #777;
        }
    </style>
    <title> Registrarse </title>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto">
                <div class="card card-signin flex-row my-5">
                    <div class="card-img-left d-none d-md-flex">
                        
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ __('Regístrate') }}</h5>
                        <form method="POST" action="{{ route('register.store') }}">
                            @csrf
                            <div class="form-group form-label-group">
                                <input type="text" class="form-control" {{ $errors->has('nombre') ? 'has-error' : ''}} placeholder="Username" id="inputUserame"  name="nombre" value="{{ old('nombre') }}" required>
                                <label for="inputUserame">{{ __('Nombre') }}</label>
                                {!! $errors->first('nombre','<span class="help-block" style="color:red;">:message</span>')!!}
                            </div>
                
                            <div class="form-label-group">
                                <input type="email" class="form-control" {{ $errors->has('email') ? 'has-error' : ''}} placeholder="Email address" id="inputEmail" name="email" value="{{ old('email') }}" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                                <label for="inputEmail">{{ __('Correo electrónico') }}</label>
                                {!! $errors->first('email','<span class="help-block" style="color:red;">:message</span>')!!}
                            </div>
                            
                            <hr>
                
                            <div class="form-label-group">
                                <input type="password" placeholder="Password" id="inputPassword" class="form-control" {{ $errors->has('password') ? 'has-error' : ''}} name="password" required>
                                <label for="inputPassword">{{ __('Contraseña') }}</label>
                                {!! $errors->first('password','<span class="help-block" style="color:red;">:message</span>')!!}
                            </div>
                            
                            <div class="form-label-group">
                                <input type="password" class="form-control" placeholder="Password" id="inputConfirmPassword"  name="password_confirmation" required>
                                <label for="inputConfirmPassword">{{ __('Confirmar Contraseña') }}</label>
                            </div>
                
                            <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Regístrate') }}</button>
                                <a class="d-block text-center mt-2 small" href="{{route('login')}}">Ingresar</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var password, password2;

        password = document.getElementById('inputPassword');
        password2 = document.getElementById('inputConfirmPassword');

        password.onchange = password2.onkeyup = passwordMatch;

        function passwordMatch() {
            if(password.value !== password2.value)
                password2.setCustomValidity('Las contraseñas no coinciden.');
            else
                password2.setCustomValidity('');
        }
    </script>
@endsection
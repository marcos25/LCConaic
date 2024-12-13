@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3 class="text-center">Acceder</h3></div>
                    <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-warning">{{ Session::get('message') }}</div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{$error}}
                                    @endforeach
                                </div> 
                            @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">Correo Electrónico</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control " name="email" placeholder="Ingresar email" value="{{ old('email') }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control " name="password" placeholder="Ingresar contraseña" required>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">{{ __('Iniciar sesión') }}</button>
                                    <a class="btn btn-link" href="register">{{ __('¿No tienes una cuenta? Regístrate.') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




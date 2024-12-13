@extends('admin.layout')
@section('content')
<title>Editar-{{$academico->nombre}}</title>
    <div class="card border-0 shadow my-5 background-style">
        <div class="card-body p-5">
            <h1 style="text-align:center">Editar usuario: {{$academico->nombre}}</h1><br><br>
            <form method= "POST" action="{{ route('academicos.update', $academico->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                    <div class="col-md-6">
                        <input id="nombre" type="text" class="form-control" name="nombre" value="{{$academico->nombre}}" required>
                        {!! $errors->first('nombre','<span class="help-block" style="color:red;">:message</span>')!!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo electrónico') }}</label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$academico->email}}" required>
                        {!! $errors->first('email', '<span style="color:red;">:message</span>') !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="knhdl +w-" required>
                        {!! $errors->first('password','<span class="help-block" style="color:red;">:message</span>')!!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="knhdl +w-">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Áreas correspondientes') }}</label>
                    <div class="col-md-6">
                        <select class="form-control" name="categoria" id="card_type" required>
                            @if (!$academico->categoria)
                                <option value="NULL">Sin asignar aún</option>
                            @else
                                <option value="NULL">Solo se visualizan las áreas que le corresponde.</option>
                                @foreach ($categorias as $categoria)
                                    @if ($categoria->academico_id == $academico->id)
                                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        {!! $errors->first('categoria','<span class="help-block" style="color:red;">:message</span>')!!}
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-info" style="float:right">
                                <span class="fa fa-edit"></span>
                            {{ __('Editar') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
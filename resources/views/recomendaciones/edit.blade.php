<!DOCTYPE html>
@extends('admin.layout')
@section('content')

    <div class="container background-style">
        <title>Editar la recomendación {{$recomendacion->nombre}}  </title>
        <h1 style="text-align:center;margin-top:20px;"> Editar la recomendación: {{$recomendacion->nombre}} </h1>
        <hr>
        <form method="POST" action='{{route('recomendacion.update',$recomendacion->id)}}'>
            @csrf
            @method("put")
            <div class="form-group" {{ $errors->has('nombreRec') ? 'has-error' : ''}}>
            <label for="exampleInputEmail1" style="font-size: 24px;">Nombre</label>
                <input type="text" class="form-control"  name='nombreRec' value="{{$recomendacion->nombre}}" placeholder="Escriba el nuevo nombre para la recomendación">
                {!! $errors->first('nombreRec','<span class="help-block" style="color:red;">:message</span>')!!}
            </div>
            <div class="form-group" {{ $errors->has('descripcionRec') ? 'has-error' : ''}}>
            <label for="exampleInputPassword1" style="font-size: 24px;">Descripción</label>
            </div>
            <textarea rows="4" cols="50" name='descripcionRec'>{{$recomendacion->descripcion}}</textarea>
            {!! $errors->first('descripcionRec','<span class="help-block" style="color:red;">:message</span>')!!}
            <hr>
            <input type="hidden" name="rutaPrevia" value="{{$rutaPrevia}}">
            <button type="submit" class="btn btn-info " style="float:right">
                <span class="fa fa-edit"></span>
                Editar recomendación
            </button>
        </form>
    </div>
@endsection

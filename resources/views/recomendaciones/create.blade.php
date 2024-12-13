<!DOCTYPE html>
@extends('admin.layout')
@section('content')

<div class="container ">
    <title> Agregar recomendación </title>
    <br>
    
    <h1 style="text-align:center;margin-top:20px;"><i>Área:</i> {{$categoria->nombre}} </h1>
    <div class="card-body p-5">
        <form method="POST" action='{{route('recomendacion.store2',$categoria->id)}}'>
            @csrf
                <label for="exampleInputEmail1" style="font-size: 24px;">Nombre:</label>
                <input type="text" class="form-control"  name='nombre' placeholder="Escriba el nombre de la recomendación..." style="margin-bottom:20px;">
                {!! $errors->first('nombre','<span class="help-block" style="color:red;">:message</span>')!!}
                <br>
                <label for="exampleInputPassword1" style="font-size: 24px;">Descripción:</label>
                <hr>
                <textarea rows="4" cols="50" name='descripcion' style="margin-bottom:20px;"></textarea>
                <br>
                {!! $errors->first('descripcion','<span class="help-block" style="color:red;">:message</span>')!!}
                <hr>    
                <button type="submit" style="background-color: green; border-color: black; color:white; float:left" class="btn pretty-btn">Agregar recomendación</button>
        </form>
    </div>
</div>
<div style="height: 50px"></div>
<p class="lead mb-0"></p>
</div>
@endsection
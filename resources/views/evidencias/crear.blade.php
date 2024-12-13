<!DOCTYPE html>
@extends('admin.layout')
@section('content')
        
<div class="container" >
    <h1 style="text-align:center">
        Subir una nueva evidencia 
    </h1>
    <title> Subir evidencia </title>
    <hr><br><br>
    <form method="POST" action="{{route('evidencias.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <h4>Nombre de la evidencia</h4>
            <input type="text" class="form-control"  name='nombreEvidencia' placeholder="Escriba el nombre de la evidencia">
            {!! $errors->first('nombreEvidencia','<span class="help-block" style="color:red;">:message</span>')!!}
        </div>
        <br><br>
        <div class="form-group">
            <h4>Archivo de la evidencia</h4>
            <input class="btn" type="file" name="archivo">
            {!! $errors->first('archivo','<span class="help-block" style="color:red;">:message</span>')!!}
        </div>

        <br><br>

        <h4>Asignar a un plan de acción</h4>
        @if($planActual) <p>Accesado desde el plan: <i>{{$planActual->nombre}}</i> </p> @endif
        @if(count($planes) > 0)
            <div class="panel panel-primary" id="result_panel">
                <div class="panel-heading"></div>
                
                <div class="panel-body">
                    <select class="form-control"  name="plan" id="card_type">
                        <option id="card_id" value="{{$planActual->id}}">{{$planActual->nombre}}</option>
                        @foreach ($planes as $plan)
                            @if($plan->id != $planActual->id)
                                <option id="card_id" value="{{$plan->id}}">{{$plan->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        @else 
            <p>No hay planes registrados.</p>
        @endif
        {!! $errors->first('plan','<span class="help-block" style="color:red;">:message</span>')!!}
        <br>
        <button style="float: right;" type="submit" class="btn btn-primary">Crear evidencia</button>
    </form>
</div>
@endsection
<!DOCTYPE html>
@extends('admin.layout')
@section('content')
    <!-- Page Content -->
    <title> Editar evidencia </title>

<div class="container">                
    <h1 style="text-align:center">Editar evidencia</h1>
    <br><br><br><br>
    <form method="POST" action='{{route('evidencias.update', $evidencia->id)}}' enctype="multipart/form-data">
        @csrf
        @method("put")
        <div class="form-group">
            <h4>Nombre de la evidencia</h4>
            <input type="text" class="form-control"  name='nombreEvidencia' value="{{ $evidencia->nombre_archivo }}" placeholder="Escriba el nombre de la evidencia">
            {!! $errors->first('nombreEvidencia','<span class="help-block" style="color:red;">:message</span>')!!}
        </div>
        <br><br>
        <div class="form-group">                            
            <h4>Cambiar archivo de la evidencia</h4>
            <input class="btn" type="file" name="archivo">
            {!! $errors->first('archivo','<span class="help-block" style="color:red;">:message</span>')!!}
            <br><br>
            <h6>Archivo actual:</h6>
            <p>{{$evidencia->archivo_bin}}</p>

        </div>

        <br><br>

        <h4>Asignado a los planes de acción:</h4>
        @foreach ($evidencia->planes as $plan)
            <ul>
                <li>{{$plan->nombre}}</li>
            </ul>
        @endforeach
        
        <br><br>
        <h4>Asignar a otro plan de acción</h4>

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
        <br>
        <button style="float: right" type="submit" class="btn btn-info">
            <span class="fa fa-edit"></span>
            Editar evidencia
        </button>
    </form>
</div>

@endsection


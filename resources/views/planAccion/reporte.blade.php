<!DOCTYPE html>
@extends('layouts.reporte')
@section('content')
    <div class="container">
    <br><br>
        <h2 style="text-align:center"> Reporte del plan de acción: {{$plan->nombre}} </h2>
        <br>
        <table style="height: 20%; width:100%;">
            <thead>
                <tr>
                   
                    <th> Recomendación </th>
                    <th> Categoría </th>
                    <th> Estado </th>
                    <th> Fecha de término </th>
                </tr>
            </thead>
            <tr>
               
                <td> {{$plan->recomendacion->nombre}} </td>
                <td> {{$plan->categoria->nombre}} </td>
                @if($plan->completado == 0)
                    <td> En progreso </td>
                @else 
                    <td> Completado </td>
                @endif
                <td> {{$plan->fecha_termino}}</td>
            </tr>
        </table>
    </div>
    <div class="container">
        <h3 style="text-align:center"> Evidencias </h3>
      
    </div>
    @foreach($plan->evidencias as $evidencia)
        @if($evidencia->tipo_archivo == "pdf")
        @else
            <h3> Nombre de la evidencia: {{$evidencia->nombre_archivo}}</h3> 
            <img src="{{ltrim($evidencia->archivo_bin, $evidencia->archivo_bin[0])}}" width="60%" height="90%" style="padding-bottom: 20px;">
        @endif
    @endforeach

@endsection

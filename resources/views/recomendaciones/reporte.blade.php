<!DOCTYPE html>
@extends('layouts.reporte')
@section('content')
<div class="container">
    <h1 style="text-align: center"> Reporte de la recomendación: {{$recomendacion->nombre}} </h1>
    <h3> Descripción: {{$recomendacion->descripcion}} </h3>
    <h4> Perteneciente a la categoria: {{$recomendacion->categoria->nombre}}</h4>
    <br>
    <table style="width:100%; height:30%">
        <thead>
            <tr>
                <th scope="col">Plan de acción</th>
                <th scope="col">Estado</th>
                <th scope="col">Fecha de término</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recomendacion->planes as $plan)
                <tr>
                    <td>{{$plan->nombre}}</td>
                    @if ( $plan->completado == 1)
                        <td>Completado.</td>
                    @else
                        <td>En progreso.</td>
                    @endif                            
                    <td>{{$plan->fecha_termino}}</td>                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
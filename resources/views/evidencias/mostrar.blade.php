<!DOCTYPE html>
@extends('admin.layout')
@section('content')
<style>
    .center-embed {
        display: block;
        margin: auto;
    }
</style>
<title> {{$evidencia->nombre_archivo}} </title>
<div class="card h-100 text-center">
    <h1 style="padding-top: 10px">{{$evidencia->nombre_archivo}}</h1>
    
    <embed class="center-embed" src="{{$evidencia->archivo_bin}}" width="800px" height="800px" style="padding-bottom: 20px;"/>

    @if(count($evidencia->planes) > 0)
        <div class="container text-center" style="-color: transparent; padding-top: 20px;">
            <h3>Para el plan de acción: <i>{{$evidencia->planes[0]->nombre}}</i></h3>
        </div>
    @else
        <div class="container text-center" style="-color: transparent; padding-top: 20px;">
            <h3>No está asignado a un plan de acción.</h3>
        </div>
    @endif
    <div style="height: 100px"></div>
        <p class="lead mb-0"></p>
    </div>
    
</div>
@endsection

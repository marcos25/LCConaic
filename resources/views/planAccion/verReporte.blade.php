<!DOCTYPE html>
@extends('admin.layout')
@section('content')
<style>
    .center-embed {
        display: block;
        margin: auto;
    }
</style>
<title> Reporte </title>
<div class="card h-100 text-center" style="background-color:transparent;">
    <h1>Reporte del plan {{$plan->nombre}}</h1>
    <embed class="center-embed" src="{{asset($archivo)}}" width="800px" height="800px" style="padding-bottom: 20px;"/>
        
    <div class="container text-center" style="background-color: hsl(360, 100%, 73%, 0.5); padding-top: 20px;">
        <p>Para el plan de acción: <i>{{$plan->nombre}}</i></p>
    </div>

    <div style="height: 100px"></div>
        <p class="lead mb-0"></p>
    </div>
    
</div>
@endsection

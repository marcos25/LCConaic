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
    <h1>Reporte de la categoría {{$categoria->nombre}}</h1>
    <embed class="center-embed" src="{{$archivo}}" width="800px" height="800px" style="padding-bottom: 20px;"/>

    <div style="height: 100px"></div>
        <p class="lead mb-0"></p>
    </div>
    
</div>
@endsection

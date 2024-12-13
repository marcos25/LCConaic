<!DOCTYPE html>
@extends('admin.layout')
@section('content')
    <!-- Page Content -->
    <title> Inicio </title>
    <div class="container">
        <div class="card border-0 shadow my-5">
            <div class="card-body" >
                <div class="container">

                    <!-- Page Heading -->
                    <h1 class="my-4" style="text-align: center">Lista de notificaciones: </small></h1>
                    <!-- Page Heading -->
                    <hr style="border-top: 5px solid rgba(0, 0, 0, 0.3);">

                    {{-- Hacemos un for loop para designar que sólo la primera carta sea del tamaño de dos columnas --}}
                    <div class="row">



                        @foreach ($notif as $categoria)

                                <div class="col-lg-12 col-md-12" style="padding-bottom: 10px">
                                    <div class="card h-100" style="background-color: transparent">
                                        <div class="card-body">
                                            <h4 class="card-title" style="text-align: center; opacity:1;">
                                                <h4 style="text-align:center; color:black">{{$categoria->nombre}}</h4>
                                            </h4>
                                            <p class="descripcion-texto" style="text-align: center;">{{$categoria->descripcion}}</p>
                                            <br>
                                            <p class="descripcion-texto" style="text-align: center;">{{$categoria->fecha}}</p>

                                            @if ( $categoria->fecha == NULL)
                                            <p class="descripcion-texto" style="text-align: center;">Sin fecha asignada </p>

                                            @endif

                                        </div>
                                    </div>
                                </div>


                        @endforeach
                    </div>
                    <!-- /.row -->


                </div>
                <!-- /.container -->
            </div>
        </div>
        <div style="height: 100px"></div>
            <p class="lead mb-0"></p>
        </div>
    </div>
@endsection


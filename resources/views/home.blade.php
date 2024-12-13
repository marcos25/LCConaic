<!DOCTYPE html>
@extends('admin.layout')
@section('content')
    <!-- Page Content -->
    <title> Inicio </title>
    <div class="container">
        <div class="card border-0 shadow my-3">
            <div class="card-body" >
                <div class="container">

                    <!-- Page Heading -->
                    <div class="card-header border-0">
                <h3 class="card-title">Lista de áreas</h3>
                <div class="card-tools">

                </div>
              </div>
                    <!-- Page Heading -->


                    {{-- Hacemos un for loop para designar que sólo la primera carta sea del tamaño de dos columnas --}}
                     @foreach ($categorias as $categoria)

                        @if ($academico->id == $categoria->academico_id)


                                      <div class="card card-primary card-outline" style="text-align: center; opacity:1;">
                      <div class="card-header">
                        <h5 class="m-0">Área de responsbilidad: {{$categoria->nombre}}</h5>
                      </div>
                      <div class="card-body">
                        <p class="card-text">{{$categoria->descripcion}}</p>
                        <a href="categorias/{{$academico->categoria->id}}" class="btn btn-primary">Ver más</a>
                      </div>
                    </div>

                                @endif
                                @endforeach



                        @foreach ($categorias as $categoria)
                            @if ($academico->id != $categoria->academico_id)


                                      <div class="card card-primary card-outline" style="text-align: center; opacity:1;">
                      <div class="card-header">
                        <h5 class="m-0">{{$categoria->nombre}}</h5>
                      </div>
                      <div class="card-body">
                        <p class="card-text">{{$categoria->descripcion}}</p>
                        <?php
                                if($categoria->academico_id == NULL){
                                ?>
                                    <h6 style="color:blue;">Sin asignar</h6>
                                <?php
                                }
                                else{
                                ?>
                                    <a href="categorias/{{$categoria->id}}" class="btn btn-primary">Ver más</a>
                                <?php
                                }
                        ?>
                      </div>
                    </div>

                            @endif


                        @endforeach

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


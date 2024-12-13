

{{-- <!DOCTYPE html>
<html lang="en">
<head>

    <title>Categorias</title>
</head>
<style>
        table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
        }
        </style>
<body>

    <h1>Lista de áreas:</h1>
    <form action="/categorias/create">
        <input type="submit" value="Crear categoria" />
    </form>
    @if($categorias->count() > 0)
        <table style="width:50%">
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Accion</th>
            </tr>

            @foreach ($categorias as $categoria)
                <tr>
                    <td>{{$categoria->nombre}}</td>
                    <td>{{$categoria->descripcion}}</td>
                    <td>
                        <div style="float: right">
                            <a class="btn btn-info btn-sm" href="/categorias/{{$categoria->id}}/edit">Editar</a> --}}
                            {{-- <a class="btn btn-info btn-sm" href="/categorias/create/{{$categoria->id}}">Agregar publicación.</a> --}}
                            {{-- <a class="btn btn-info btn-sm" href="{{route('categorias.show',$categoria->id)}}">Produccion academica</a> --}}
                            {{-- <form style="float:left" action="{{ route('categorias.destroy',$categoria->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Quiere borrar la categoria: {{ $categoria->nombre }}?')" >Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </table>

    @else
        <p>No hay categorías registradas.</p>
    @endif

</body>
</html> --}}
<!DOCTYPE html>
@extends('admin.layout')
@section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<style>
    .center-column {
        display: block;
        margin: auto;
    }
</style>
<title>Listado de áreas</title>
     <!-- Page Content -->


<div class="card" align="center">
              <div class="card-header border-0">
                <h3 class="card-title">Lista de áreas</h3>
                <div class="card-tools">

                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>

                  </tr>
                  </thead>
                  <tbody>

        @foreach ($categorias as $categoria)

                <tr>

                    <td>
                                <?php
                                if($categoria->academico_id == NULL){
                                ?>
                                    <h6 style="color:blue;">{{$categoria->nombre}}</h6>
                                <?php
                                }
                                else{
                                ?>
                                    <a style="color:blue !important;" href="{{route('categorias.show',$categoria->id)}}">{{$categoria->nombre}}</a>
                                    </a>
                                <?php
                                }
                                ?>
                    </td>
                <td style="height:10px;"><p class="descripcion-texto">{{$categoria->descripcion}}</p></td>
                    <td style="width:150px">
                        <div class="d-flex">

                            <div class="col-lg-8 col-md-8 flex-fill">
                                <center>
                                <?php
                                if($categoria->academico_id == NULL){
                                ?>
                                    <h6 style="color:blue;">Sin asignar</h6>
                                <?php
                                }
                                else{
                                ?>
                                    <a type="button" style="color:white ;" class="btn btn-info btn-sm" href="{{route('categorias.show',$categoria->id)}}">

                                        Ver área
                                    </a>
                                <?php
                                }
                                ?>
                                </center>
                            </div>

                            <div class="col-lg-6 col-md-6 flex-fill">
                                <form style="margin: 0px;" action="{{ route('categorias.destroy',$categoria->id) }}"  method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <center>
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Quiere borrar la categoria: {{ $categoria->nombre }}?')" >
                                            <span class="fa fa-trash"></span>
                                        Eliminar
                                    </button>
                                    </center>
                                </form>
                            </div>

                            <div class="col-lg-6 col-md-6 flex-fill">
                                <center>
                                <a type="button" style="color:white !important;" class="btn btn-info btn-sm" href="/categorias/{{$categoria->id}}/edit">
                                        <span class="fa fa-edit"></span>
                                    Editar
                                </a>
                                </center>
                            </div>

                        </div>
                    </td>
                </tr>




        @endforeach


                  </tbody>
                </table>

            </div>
            <br>
            <div class="box-footer">
                <form action="/categorias/create">
                    {{-- <button type="submit" style="float:right; background-color:grey" class="btn pretty-btn"  type="submit" value="">Crear área</button> --}}
                    <input style="float:right; background-color:grey; color:white" class="btn pretty-btn"  type="submit" value="Crear área" />
                </form>
            </div>
            <br>
            </div>
</div>


@stop
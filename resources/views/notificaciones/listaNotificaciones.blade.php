{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>Categorias</title>
</head>
<style>
        table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
        }
        </style>
<body>

    <h1>Lista de notificaciones:</h1>
    <form action="/categorias/create">
        <input type="submit" value="Crear categoria" />
    </form>
    
    
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
<title>Listado de notificaciones</title>
     <!-- Page Content -->

<div class="container">
    <h1 class="text-center">Listado de notificaciones</h1>
    <br>               
    @if($notif->count() > 0)
        <table class="table table-hover"  >
            <thead class="thead-dark">
                <tr>
                    <th style="min-width: 1%;">Nombre</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th style="width: 14%;">Acciones</th>
                </tr>
            </thead>
        @foreach ($notif as $notificacion)
            <tr>
                <td><a style="color:black !important;" >{{$notificacion->nombre}}</a></td>
                <td style="height:10px;"><p class="descripcion-texto">{{$notificacion->descripcion}}</p></td>
                <td style="height:10px;"><p class="descripcion-texto">{{$notificacion->fecha}}</p></td>
                <td>
                    <div class="container">
                        <br>
                        <div class="row">                                
                        
                            <div class="col-lg-6 text-center">
                                <form action="{{ route('notificaciones.destroy',$notificacion->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Quiere borrar la categoria: {{ $notificacion->nombre }}?')" >
                                                Borrar <span class="fa fa-trash"></span>
                                    </button>
                                </form>
                            </div>

                            <div class="col-lg-6 text-center">
                                <a style="color:white !important;" class="btn btn-info btn-sm" href="/notificaciones/{{$notificacion->id}}/edit">Editar <span class="fa fa-pencil"></span></a> 
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </table>
            
    @else 
        <p>No hay categorías registradas.</p>
    @endif      
    
    <br>
    <form action="/notificaciones/create">
        {{-- <button type="submit" style="float: right; background-color:grey" class="btn pretty-btn"  type="submit" value="">Crear notificación</button> --}}
        <input style="float: right; background-color:grey; color:white" class="btn pretty-btn"  type="submit" value="Crear notificación" />
    </form><br>     
    <div style="height: 100px"></div>
        <p class="lead mb-0"></p>
    </div>
</div> 

@endsection
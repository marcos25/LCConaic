{{-- <!DOCTYPE html>
<html lang="en">
    <style>
    .list-group{
    max-height: 300px;
    margin-bottom: 10px;
    overflow:scroll;
    
    -webkit-overflow-scrolling: touch;
    }
    .panel-primary{
        width: 50%;
    }
    </style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear categoría</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
    <form method="POST" action='{{route('notificaciones.store')}}'>
        @csrf
        <div class="form-group" {{ $errors->has('nombreCategoria') ? 'has-error' : ''}}>
          <label for="exampleInputEmail1">Nombre</label>
          <input type="text" class="form-control"  name='nombreCategoria' placeholder="Escriba el nombre de la categoria">
          {!! $errors->first('nombreCategoria','<span class="help-block" style="color:red;">:message</span>')!!}
        </div>
        <div class="form-group " {{ $errors->has('descripcionCategoria') ? 'has-error' : ''}}>
          <label for="exampleInputPassword1">Descripcion</label>
          <textarea rows="4" cols="50" name='descripcionCategoria'></textarea>
          {!! $errors->first('descripcionCategoria','<span class="help-block" style="color:red;">:message</span>')!!}
        </div>
        
        @if($notif->count() > 0)
            <div class="panel panel-primary" id="result_panel">
                <div class="panel-heading"><h3 class="panel-title">Lista de académicos</h3>
                </div>
                <div class="panel-body">
                    <select class="form-control" name="academicoID" id="card_type">
                        <option id="card_id"  value="NULL">Sin asignar</option>
                        @foreach ($notif as $academico)
                            <option id="card_id"  value="{{$academico->id}}">{{$academico->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @else 
                <p>No hay académicos registrados.</p>
                <input class='hidden' name='academicoID' value='NULL'>
            @endif
        <button type="submit" class="btn btn-primary">Crear categoría</button>
      </form>
      
      
</body>
</html> --}}
<!DOCTYPE html>
@extends('admin.layout')
@section('content')
      <!-- Page Content -->
    <title> Crear notificación </title>
  <div class="container ">
              <div class="card-body p-5">
            <h1>Crear notificación</h1>
          <form method="POST" action='{{route('notificaciones.store')}}'>
              @csrf
              <div class="form-group" {{ $errors->has('nombreCategoria') ? 'has-error' : ''}}>
                <label for="exampleInputEmail1">Nombre</label>
                <input type="text" class="form-control"  name='nombreCategoria' placeholder="Nombre de la notificación">
                {!! $errors->first('nombreCategoria','<span class="help-block" style="color:red;">:message</span>')!!}
              </div>
              <div class="form-group " {{ $errors->has('descripcionCategoria') ? 'has-error' : ''}}>
                <label for="exampleInputPassword1">Descripción</label>
                <textarea rows="4" class='form-control' cols="50" name='descripcionCategoria'></textarea>
                {!! $errors->first('descripcionCategoria','<span class="help-block" style="color:red;">:message</span>')!!}
              </div>

              <div>
                <h4>Fecha </h4>
     

            <?php $fcha = date("Y-m-d");?>

          <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $fcha;?>" >
              </div>
              <hr>
              
             
              <button type="submit" class="btn pretty-btn" style="float: left; background-color:green; color:white">Crear notificación</button>
            </form>                      
        </div>
    </div>
@endsection
  


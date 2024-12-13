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
    <title>Crear categoria</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
    
      
</body>
</html> --}}
<!DOCTYPE html>
@extends('admin.layout')
@section('content')
     <!-- Page Content -->
  <title> Editar {{$notif->nombre}} </title>
  <div class="container background-style">
    <div class="card border-0 shadow my-5">
      <div class="card-body p-5">
        <h1 class="font-weight-light">Editar notificación</h1>
        <form method="POST" action="{{ route('notificaciones.update',$notif->id)}}">
                @csrf
                @method("put")
                <div class="form-group" {{ $errors->has('nombreCategoria') ? 'has-error' : ''}}>
                  <label for="exampleInputEmail1"><strong>Nombre</strong></label>
                  <input type="text" class="form-control"  name='nombreCategoria' value="{{$notif->nombre}}" placeholder="Escriba el nombre para la categoría">
                  {!! $errors->first('nombreCategoria','<span class="help-block" style="color:red;">:message</span>')!!}
                </div>
                <div class="form-group" {{ $errors->has('descripcionCategoria') ? 'has-error' : ''}}>
                  <label for="exampleInputPassword1" ><strong>Descripción</strong></label>
                  <textarea rows="4" cols="50" class="form-control" name='descripcionCategoria'>{{$notif->descripcion}}</textarea>
                  {!! $errors->first('descripcionCategoria','<span class="help-block" style="color:red;">:message</span>')!!}
                </div>

                
              <hr>
               
               
                    
                     

               
              
                <button type="submit" style=" border-color: black; color:white; position:relative;top:10px"
                   class="btn btn-info ">
                   <span class="fa fa-edit"></span>
                  Guardar
                </button>
              </form>
        <div style="height: 200px"></div>
        
      </div>
    </div>
@endsection
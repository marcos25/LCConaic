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
    <form method="POST" action="{{ route('categorias.update',$categoria->id)}}">
        @csrf
        @method("put")
        <div class="form-group" {{ $errors->has('nombreCategoria') ? 'has-error' : ''}}>
          <label for="exampleInputEmail1">Nombre</label>
          <input type="text" class="form-control"  name='nombreCategoria' value="{{$categoria->nombre}}" placeholder="Escriba el nombre para la categoria">
          {!! $errors->first('nombreCategoria','<span class="help-block" style="color:red;">:message</span>')!!}
        </div>
        <div class="form-group" {{ $errors->has('descripcionCategoria') ? 'has-error' : ''}}>
          <label for="exampleInputPassword1">Descripción</label>
          <textarea rows="4" cols="50"  name='descripcionCategoria'>{{$categoria->descripcion}}</textarea>
          {!! $errors->first('descripcionCategoria','<span class="help-block" style="color:red;">:message</span>')!!}
        </div>
        @if($academicos->count() > 0)
            <div class="panel panel-primary" id="result_panel">
                <div class="panel-heading"><h3 class="panel-title">Lista de académicos</h3>
                </div>
                <div class="panel-body">
                    <select class="form-control" name="academicoID" id="card_type">
                        <option id="card_id"  value="NULL">Sin asignar</option>
                        @foreach ($academicos as $academico)
                            <option id="card_id"  value="{{$academico->id}}">{{$academico->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @else
                <p>No hay académicos registrados.</p>
                <input class="hidden" value='NULL'>
            @endif
        <button type="submit" class="btn btn-primary">Crear categoría</button>
      </form>


</body>
</html> --}}
<!DOCTYPE html>
@extends('admin.layout')
@section('content')
     <!-- Page Content -->
  <title> Editar {{$categoria->nombre}} </title>
  <div class="container background-style">
    <div class="card border-0 shadow my-5">
      <div class="card-body p-5">
        <h1 class="font-weight-light">Editar el área: {{$categoria->nombre}}</h1>
        <form method="POST" action="{{ route('categorias.update',$categoria->id)}}">
                @csrf
                @method("put")
                <br>
                <div class="form-group" {{ $errors->has('nombreCategoria') ? 'has-error' : ''}}>
                  <label for="exampleInputEmail1"><strong>Nombre</strong></label>
                  <input type="text" class="form-control"  name='nombreCategoria' value="{{$categoria->nombre}}" placeholder="Escriba el nombre para la categoría">
                  {!! $errors->first('nombreCategoria','<span class="help-block" style="color:red;">:message</span>')!!}
                </div>
                <br>
                <div class="form-group" {{ $errors->has('descripcionCategoria') ? 'has-error' : ''}}>
                  <label for="exampleInputPassword1" ><strong>Descripción</strong></label>
                  <textarea rows="4" cols="50" class="form-control" name='descripcionCategoria'>{{$categoria->descripcion}}</textarea>
                  {!! $errors->first('descripcionCategoria','<span class="help-block" style="color:red;">:message</span>')!!}
                </div>

                {{-- @if($academicoSinCategoria->count() > 0) --}}
                    <div class="panel panel-primary" id="result_panel">
                        {{-- checo si existe un academico con isset($var), esto regresa un booleano --}}
                        @if(isset($academicoAsignado))
                          <br>
                          <div class="panel-heading"><h3 class="panel-title">Académico asignado a esta categoría: {{$academicoAsignado->nombre}}</h3>
                        @else
                        <div class="panel-heading"><h3 class="panel-title">Esta categoría por el momento no tiene ningún académico asignado.</h3>
                        @endif

                      <br>
                        <div class="panel-heading"><h3 class="panel-title">Asignar área a:</h3>
                        </div>
                        <br>
                        <div class="panel-body">
                            <select class="form-control" name="academicoID" id="card_type">
                                {{-- <option id="card_id"  value="NULL">Sin asignar</option> --}}
                                @if(isset($academicoAsignado))
                                  <option id="card_id"  selected value="{{$academicoAsignado->id}}">{{$academicoAsignado->nombre}}</option>
                                @else
                                  <option id="card_id"  value="NULL">Sin asignar</option>
                                @endif
                                @foreach ($academicos as $academico)
                                  <option id="card_id"  value="{{$academico->id}}">{{$academico->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- @else

                        @if(isset($academicoAsignado))
                            <div class="panel-heading"><h3 class="panel-title">Académico asignado a esta categoría: {{$academicoAsignado->nombre}}</h3>
                        @else
                            <div class="panel-heading"><h3 class="panel-title">Esta categoría por el momento no tiene ningún académico asignado.</h3>
                        @endif
                        <select class="form-control" name="academicoID" id="card_type">
                            <option id="card_id"  value="NULL">Sin asignar</option>

                            @if(isset($academicoAsignado))
                                <option id="card_id"  selected value="{{$academicoAsignado->id}}">{{$academicoAsignado->nombre}}</option>
                            @endif
                        </select>

                    @endif --}}
                <br>
                <button type="submit" style=" border-color: black; color:white; position:relative;top:10px"
                   class="btn btn-info ">
                   <span class="fa fa-edit"></span>
                  Editar categoría
                </button>
              </form>
        <div style="height: 200px"></div>

      </div>
    </div>
@endsection
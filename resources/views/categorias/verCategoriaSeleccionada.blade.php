@extends('admin.layout')
@section('content')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="/calendarJS/source/jsCalendar.css">
<script type="text/javascript" src="/calendarJS/source/jsCalendar.js"></script>
<script type="text/javascript" src="/calendarJS/source/jsCalendar.lang.es.js"></script>
<div class="container">
    {{-- <title>{{$categoria->nombre}}</title>
    <div class="card border-0 shadow my-5 text-center background-style">

        <p style="font-size:12px"><i>Categoría seleccionada:</i></p>
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <h1 style="font-family: helvetica">{{$categoria->nombre}}</h1>
            </div>
            @if(auth()->user()->privilegio == 1)
                <div class="col-lg-3">
                    <a style="color:white !important;" class="btn btn-success btn-md" href="{{ route('categoria.reporte', $categoria->id) }}">
                        <span class="fa fa-download"></span>
                        Generar reporte
                    </a>
                </div>
            @endif
        </div>
        <div class="container">
            @if(isset($categoria->academico))
                <h3>Usuario encargado: {{$categoria->academico->nombre}}</h3>
            @else
                <h6><i>No hay ningún académico asignado a esta categoría.</i></h6>
            @endif
        </div>
        <br>
        <hr>
        <h2>Descripción</h2>
        <p>{{$categoria->descripcion}}</p>
        <hr>

        <div class="container">

            @if(!$categoria->recomendaciones->isEmpty())
                <h2 class="panel-title">Recomendaciones para esta categoría:</h2>
                <hr>
                @foreach ($recomendaciones as $recomendacion)
                    <h4>{{$recomendacion->nombre}}</h4>

                    <div class="row">
                    <div class="col-lg-4 col-md-3">
                        <br>
                    @if (auth()->user()->privilegio==1)
                            <a  class="btn btn-info btn-md" href="/recomendacion/{{$recomendacion->id}}/edit" style="color:white !important;">
                                <span class="fa fa-edit"></span>
                                Editar
                            </a>
                            <br><br>
                    @endif
                    </div>
                        <div class="col-lg-4 col-md-3">
                                <br>
                            <a  href="/recomendacion/{{$recomendacion->id}}" class="btn" style="background-color: grey; border-color: black; color:white !important;">Ver recomendación</a>
                            <br>
                        </div>

                    @if (auth()->user()->privilegio==1)
                        <div class="col-lg-4 col-md-3">
                            <form action="{{ route('recomendacion.destroy',$recomendacion->id) }}" method="POST" style="">
                                @csrf
                                @method('DELETE')
                                <br>
                                <button type="submit" class="btn btn-danger btn-md"
                                    onclick="return confirm('¿Quiere borrar la recomendación: {{ $recomendacion->nombre }}?')"
                                    >
                                    <span class="fa fa-trash"></span>
                                    Eliminar
                                </button>
                                <br>
                            </form>
                        </div>
                    @endif
                    </div>

                    <hr>
                @endforeach

            @else
                <div class="panel-heading"><h3 class="panel-title">No hay recomendaciones asignadas para esta categoría. </h3>
                </div>
            @endif
            @if (auth()->user()->privilegio == 1 )
                <div class="row">
                    <div class="col-lg-4 col-md-3">
                    </div>
                    <div style="text-align:center" class="col-lg-4 col-md-3">
                        <form action="/recomendacion/create/{{$categoria->id}}" style="position:relative; top:50%;">
                            <input style="color: white; background-color: grey; border-color: black" type="submit" class="btn btn-primary btn-lg" value="Agregar recomendación" />
                        </form>
                    </div>
                </div>
            @endif
        </div>


        <div style="height: 100px"></div>
            <p class="lead mb-0"></p>
        </div>
    </div> --}}





    <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> Área: {{$categoria->nombre}}


         @if (auth()->user()->privilegio == 1 || auth()->user()->id == $categoria->academico_id )


 <div class="box-footer">
        <button type="button" class="btn btn-success btn-md"   style="float:right; color:white !important;" data-toggle="modal" data-target="#agregarAcademicoModal">Generar reporte</button>
    </div>

                  {{--Modal para Registrar a un usuario--}}
    <div class="modal fade" id="agregarAcademicoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Seleccionar fechas para reporte</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method= "POST" action="{{ route('reporte.area', $categoria->id) }}">
                        @csrf




                             <!-- My calendar element -->
                        <div>
                            Dentro de este rango de fechas se tomarán las acciones que aparecerán en el reporte.
                            <hr>
      <h2>Rango inicial</h2>

                <input type="date" id="rangoin" name="rangoin" required>



                        </div>

                                    <div>
      <h2>Rango final</h2>

                         <input type="date" id="rangof" name="rangof" required>



                        </div>
                        <!-- Create the calendar -->



                        <div class="form-group row mb-4">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-secondary" value="Generar">{{ __('Generar') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    {{--Fin Modal para Registrar a un usuario--}}












                    @endif

                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">

                  <address>
                    <strong>Encargado: </strong>
                    {{$categoria->academico->nombre}}


                  </address>
                </div>
                <!-- /.col -->

                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <address>
                 <strong>Descripción: </strong>
                    {{$categoria->descripcion}}
                </address>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->



              <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="recomendaciones-tab" data-toggle="tab" href="#recomendaciones" role="tab" aria-controls="recomendaciones" aria-selected="true">Recomendaciones</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="planes-tab" data-toggle="tab" href="#planes" role="tab" aria-controls="planes" aria-selected="false">Planes de acción</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="recomendaciones" role="tabpanel" aria-labelledby="recomendaciones-tab">
            @if(count($categoria->recomendaciones) > 0)
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                        <th>Recomendación</th>
                        <th>Descripción</th>
                        @if(auth()->user()->id == $categoria->academico_id || auth()->user()->privilegio == 1)
                            <th>Acciones</th>
                        @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categoria->recomendaciones as $recomendacion)
                            <tr>
                                <td><a href="{{route('recomendacion.show',$recomendacion->id)}}">{{$recomendacion->nombre}}</a></td>
                                <td>{{$recomendacion->descripcion}}</td>
                                @if (auth()->user()->id == $categoria->academico_id || auth()->user()->privilegio == 1)
                                    <td style="width:200px">


                                        <center>
                                        <form action="{{ route('plan.create')}}">
                                            <input type='hidden' value='{{$recomendacion->id}}' name='rec_id'/><br>
                                             <input type='hidden' value='{{$categoria->id}}' name='rec_idc'/><br>
                                            <input type='submit' class="btn btn-info btn-sm" value='Agregar plan de acción'/>
                                        </form>

                                        </center>



                                        <center>
                                        <form action="{{route('recomendacion.show',$recomendacion->id)}}">
                                           <br>
                                            <input type='submit' class="btn btn-info btn-sm" value='Ver recomendación'/>
                                        </form>


                                        </center>




                                    </td>
                                @endif
                            <tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <br>
                <p>No hay recomendaciones.</p>
            @endif
        </div>
        <div class="tab-pane fade" id="planes" role="tabpanel" aria-labelledby="planes-tab">
            @if(count($planes) > 0)
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                        <th>Plan de acción</th>
                        <th>Pertenece a la recomendación</th>
                        <th>Completado</th>
                        <th>Fecha de término</th>
                        @if(auth()->user()->id == $categoria->academico_id || auth()->user()->privilegio == 1)
                            <th>Acciones</th>
                        @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($planes as $plan)
                            <tr>

                                <td><a href="{{route('plan.show',$plan->id)}}">{{$plan->nombre}}</a></td>
                                <td>{{$plan->recomendacion->nombre}}</td>
                                @if($plan->completado == 0)
                                    <td>No</td>
                                @else
                                    <td>Sí</td>
                                @endif
                                <td>{{$plan->fecha_termino}}</td>
                                @if(auth()->user()->id == $categoria->academico_id || auth()->user()->privilegio == 1)
                                <td>
                                    <div class="container">
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6 text-center">
                                                <form action="{{ route('plan.destroy',$plan->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Quiere borrar el plan de acción: {{ $plan->nombre }}?')" >
                                                                Borrar <span class="fa fa-trash"></span>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-sm-6 text-center">
                                                <a style="color:white !important;" class="btn btn-info btn-sm" href="/plan/{{$plan->id}}/edit">Editar <span class="fa fa-pencil"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <br>
                <p>No hay planes para esta área.</p>
            @endif
        </div>
    </div>
    @if (auth()->user()->privilegio == 1  )
        <div class="row">
            <div class="col-lg-4 col-md-3">
            </div>
            <div style="text-align:center" class="col-lg-4 col-md-3">
                <form action="/recomendacion/create/{{$categoria->id}}/{{auth()->user()->id}}" style="position:relative; top:50%;">
                    <input type="submit" class="btn btn-primary" value="Agregar recomendación" />
                </form>
            </div>
        </div>
    @endif

    <div style="height: 100px"></div>
        <p class="lead mb-0"></p>
    </div>
              <!-- /.row -->


              <!-- /.row -->

              <!-- this row will not appear when printing -->


</div>
@endsection
<!DOCTYPE html>
@extends('admin.layout')
@section('content')

<style>
    .center-cropped {
        padding-top: 20px;
        width: 200px;
        height: 200px;

        display: block;
        margin: auto;
        
    }
    .center-embed {
        display: block;
        margin: auto;
    }
</style>

{{-- <style>
    .col-centered{
        float: none;
        margin: 0 auto;
    }
    .styling-btn {
        padding-top: 10px;
        padding-bottom: 10px;
        font-size: 20px;
    }
</style>
    <title> {{$plan->nombre}} </title>
    <div class="container">
        <div class="card border-0 shadow my-5 text-center background-style">
            <div class="card h-100 text-center" style="background-color:transparent;">
                <br>
                <p style="font-size:12px"><i>Plan de acción:</i></p>
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <h1 style="font-family: helvetica">{{$plan->nombre}}</h1>
                    </div>
                    @if(auth()->user()->privilegio == 1)
                        <div class="col-lg-3">
                            <a style="color:white !important;" class="btn btn-success btn-md" href="{{ route('plan.reporte', $plan->id) }}">
                                <span class="fa fa-download"></span> 
                                Generar reporte
                            </a>
                        </div>
                    @endif
                    
                </div>
                <div class="row text-center">
                    @if($plan->categoria)
                        <div class="col"><h6 class="panel-title" style="text-align: center; "><i>Pertenece a la categoría: {{$plan->categoria->nombre}} </i></h6></div>
                        @if (isset($categoria->academico))
                            <div class="col"><h6 class="panel-title" style="text-align: center; "><i>Encargado de la categoría: {{$plan->categoria->academico->nombre}} </i></h6></div>
                        @else
                            <div class="col"><h6 class="panel-title" style="text-align: center; "><i>No hay academico </i></h6></div>
                        @endif
                        
                        <div class="col"><h6 class="panel-title" style="text-align: center; "><i>Fecha de término: {{$plan->fecha_termino}} </i></h6></div>
                    </div>
                    @else
                        <div class="col"><h6 class="panel-title"><i>No hay ningún profesor asignado a esta categoría.</i></h6>
                        </div>
                    @endif
                </div>
                <br>
                <div class="row text-center">
                        <hr>
                    <div class="col">
                        <h2>Descripción</h2>
                        <p>{{$plan->descripcion}}</p>
                        <hr>
                        <h2> Criterio de hecho </h2>
                        @if($plan->criterio == NULL)
                         
                        @else
                            <p> {{$plan->criterio}}</p>
                        @endif
                    </div>                    
                </div>
                <div class="container">
                    @if(auth()->user()->categoria)
                        @if($plan->categoria->id == auth()->user()->categoria->id)
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-3 col-centered">
                                    </div>
                                    <div class="col-lg-3 col-centered">
                                        <form action="{{ route('plan.destroy', $plan->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                                <button style="background: linear-gradient(to bottom right, #800000 1%, #cc0000 100%);" type="submit" style="color: black" class="btn btn-danger btn-sm btn-block" 
                                                onclick="return confirm('¿Está seguro de borrar este plan?')" >
                                                <span class="fa fa-trash styling-btn"></span>
                                                    Eliminar
                                                </button>
                                    </div>
                                    <div class="col-lg-3 col-centered">
                                                <a style="color:white !important;" class="btn btn-info btn-sm btn-block" href="/plan/{{$plan->id}}/edit">
                                                    <span class="fa fa-edit styling-btn"></span>
                                                    Editar
                                                </a>
                                        </form>
                                    </div>
                                    <div class="col-lg-3 col-centered">
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                    <br>
                    <form method="POST" action='{{route('plan.completado',$plan->id)}}'>
                        @csrf
                        @method('put')
                        <div class="form-group" >
                            <label for="exampleInputPassword1" style="font-size: 24px;">Plan completado</label>
                            <select name="completado">                                
                                @if ($plan->completado == 0)
                                    <option value="0" selected>No</option>
                                    <option value="1">Sí</option>
                                @else 
                                    <option value="0">No</option>
                                    <option value="1" selected>Sí</option>
                                @endif
                            </select>
                        </div>
                        <button style="background: linear-gradient(to bottom right, #000000 1%, #999966 101%);" type="submit" class="btn btn-sm btn-secondary">Actualizar plan</button>
                    </form>
                    <hr>    
                    @if(!$plan->evidencias->isEmpty())
                        <h2>Evidencias para este plan:</h2>
                        <hr>
                        @foreach ($evidencias as $evidencia)
                            <h4>{{$evidencia->nombre_archivo}}</h4>
                            <p><i>Archivo asociado:</i> {{$evidencia->archivo_bin}}</p>
                                <a href="/evidencias/{{$evidencia->id}}" class="btn" style="background: linear-gradient(to bottom right, #339933 1%, #33cc33 101%);">Ver evidencia</a>
                            <br><br>                            
                        @endforeach                                                

                    @else                    
                        <div class="panel-heading"><h6 class="panel-title"><i>No hay evidencias para este plan de acción.</i></h6>
                        </div>
                    @endif

                </div>
                <div style="height: 100px"></div>
                    <p class="lead mb-0"></p>
                </div>
            </div>
        </div>
    </div> --}}
<div class="container">
    <title> {{$plan->nombre}} </title>

         
    </div>

    
        
    






     <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                 <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> Plan de acción: {{$plan->nombre}}
                     @if (auth()->user()->privilegio == 1  ) 

        <!--
        <a style="float:right; color:white !important;" class="btn btn-success btn-md" href="{{ route('plan.reporte', $plan->id) }}">
            <span class="fa fa-download"></span>
            Generar reporte
        </a>
    -->


                <a style="float:right; color:white !important;" class="btn btn-success btn-md" href="{{ route('reporte.plan', $plan->id) }}">
                    <span class="fa fa-download"></span>
                    Generar reporte
                </a>
                <br><br>
            @endif

                  </h4>


                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  
                  <address>
                    <strong> Recomendación: </strong>
                    {{$plan->categoria->nombre}} 
                    
                    
                  </address>
                </div>
                <!-- /.col -->
               
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <address>
                 <strong>Descripción: </strong>
                    {{$plan->descripcion}}
                </address>
                </div>

                 <div class="col-sm-4 invoice-col">
                    <address>
                 <strong>Observación </strong>
                    {{$plan->criterio}}
                </address>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <hr>
              
                <div class="row text-center">
        <div class="col-lg-12 col-md-12">
            <h4>Evidencias registradas:</h4>
            <br>
        </div>
    </div>

             @if($plan->evidencias->count() > 0)
        <div class="row" >
            {{-- @php $evidencias = $plan->evidencias; @endphp --}}
            @foreach($plan->evidencias as $evidencia)
                
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100" style="background-color: transparent">
                        
                        @if($evidencia->tipo_archivo == "pdf")
                            <embed class="center-embed" src="/archivos/pdf_preview.png" width="80px" height="80px" />
                        @else
                            <embed class="center-embed" src="{{$evidencia->archivo_bin}}" width="80px" height="80px" />
                        @endif                        
                        
                        <div class="card-body">
                            <h6 class="card-title" >
                                <a href="/evidencias/{{$evidencia->id}}"><p style="text-align: center; color:black;">{{$evidencia->nombre_archivo}}</p></a>

                            </h6>

                            @if (auth()->user()->id == $plan->recomendacion->categoria->academico_id)
                              
                                    <div class="col-lg-10 col-md-10 col-sm-10">
                                        <form action="{{ route('evidencias.destroy', $evidencia->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm btn-block" 
                                                onclick="return confirm('¿Está seguro de borrar la evidencia?')" >
                                                <span class="fa fa-trash"></span>
                                                Eliminar
                                            </button>
                                        </form>
                                        <br>
                                    </div>



                                    <div class="col-lg-10 col-md-10 col-sm-9">
                                        <a style="float:right; color:white !important;" class="btn btn-primary btn-sm btn-block" href="{{route('evidencias.edit', $evidencia->id)}}">
                                            <span class="fa fa-edit"></span>
                                            Editar
                                        </a>
                                        
                                    </div>
                                
                            @endif
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    @else
        <br>
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <h4>No hay evidencias registradas.</h4>
            </div>
            
            
        </div>
    
    @endif
    <hr>

    @if(auth()->user()->id == $plan->recomendacion->categoria->academico_id || auth()->user()->privilegio == 1)        
        <a href="{{route('evidencias.create', ['id' => $plan->id])}}" class="btn" style="float:right; color:white !important; background-color: grey; border-color: black">Crear nueva evidencia</a>
    @endif

    <div style="height: 100px"></div>
        <p class="lead mb-0"></p>
    </div>

    

    <div style="height: 100px"></div>
        <p class="lead mb-0"></p>
    </div>








</div>







@endsection
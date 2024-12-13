<!DOCTYPE html>
@extends('admin.layout')
@section('content')
<div class="container background-style">
    <div class=" text-center" style="background-color: transparent">
    <title>Categoría asignada</title>
        <p style="font-size:12px; padding-top:10px;"><i>Categoría seleccionada:</i></p>
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
        </div> {{-- Fin row principal --}}   
        @if(isset($categoria->academico))
            <h6>Encargado de la categoría: <i>{{$categoria->academico->nombre}}</i> </h6>
        @else
            <h6><i>Sin profesor asignado a esta área.</i></h6>
        @endif
        
        <br>
        
        <hr>
        <h2>Descripción</h2>
        <p class="descripcion-texto">{{$categoria->descripcion}}</p><br> <br>
        <hr> 
    
        
        @if(!$categoria->recomendaciones->isEmpty())
            <h1>Recomendaciones para esta área:</h1>
            <br>
            <br>
            @foreach ($recomendaciones as $recomendacion)
            <div class="card-body">
            
                <h2><a href="/recomendacion/{{$recomendacion->id}}">{{$recomendacion->nombre}}</a></h2>
                <div class="form-group">
                    <form action="{{ route('plan.create')}}">
                        <input type='hidden' value='{{$recomendacion->id}}' name='rec_id'/><br>
                        <input type='submit' class="btn btn-secondary" value='Agregar plan de acción'/>
                    </form>
                </div>
                @if($recomendacion->planes->count() != 0)
                    <div class="container">
                        <br>
                        <p style="font-size:12px"><i>Planes de acción:</i></p>
                        @foreach($recomendacion->planes as $plan)
                            <a href="/plan/{{$plan->id}}" ><h4 >{{ $plan->nombre }}</h4></a>
                            <form method="POST" action='{{route('plan.completado',$plan->id)}}'>
                                @csrf
                                @method('put')
                                <div class="form-group" >
                                    {{-- checo si el plan esta completado o no para que el usuario pueda ver el estado del
                                         la etiqueta
                                    --}}
                                    @if ($plan->completado == 0)
                                        <label for="exampleInputPassword1" style="font-size: 24px;">Plan en progreso</label>
                
                                    @else 
                                        <label for="exampleInputPassword1" style="font-size: 24px;">Plan completado <span style="color:#00A800;" class="fa fa-check"></span></label>
                
                                    @endif                                    
                                </div>
                            </form>
                            <br>
                            @if(count($plan->evidencias) > 0)
                                <table class="table table-bordered table-hover">
                            <br>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th>Evidencias</th>
                                        <th>Archivo asignado</th>
                                        <th>Tipo archivo</th>
                                        </tr>
                                    </thead>
                                    @foreach($plan->evidencias as $evidencia)
                                        <tbody>
                                            <tr>
                                                <td>{{$evidencia->nombre_archivo}}</td>
                                                <td>{{$evidencia->archivo_bin}}</td>
                                                <td>{{$evidencia->tipo_archivo}}</td>
                                            </tr>
                                        </tbody>
                                    @endforeach                                
                                </table>
                                
                                
                            @else
                            <br>
                                <p style="font-size:12px"><i>No hay evidencias asignadas para este plan de acción.</i></p>
                            @endif
                            
                        @endforeach
                        
                    </div>
                    
                @else
                    <p style="font-size:12px"><i>No hay planes asignados para esta recomendación.</i></p>
                @endif 
                <hr>
            </div>
            
            @endforeach                
        @else            
            <h6><i>No hay recomendaciones asignadas para esta área.</i></h6> 
        @endif
        {{-- checa si el usuario que ve esta vista es el super usuario --}}
        @if (auth()->user()->privilegio == 1) 
        <div style="text-align:center">
            <form action="/recomendacion/create/{{$categoria->id}}">
                
                <input style="background-color: grey; border-color: black; color:white; position:relative;top:50%;" 
                    type="submit" class="btn btn-primary btn-lg" 
                    value="Agregar recomendación" />
            </form>
        </div>
        @endif
        
    </div>
    <div style="height: 50px"></div>
        <p class="lead mb-0"></p>
    </div>
    
</div> {{-- Fin container principal --}}
<div style="height: 50px"></div>
        <p class="lead mb-0"></p>
</div>
@endsection
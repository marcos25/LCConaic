<!DOCTYPE html>
@extends('layouts.reporte')
@section('content')
    @if($planes->count() > 0)
        <table class="table table-bordered ">
            <thead>
                <tr>
                    <th>Recomendación</th>
                    <th>Plan de acción</th>
                    <th>Fecha de término</th>
                    <th>Completado</th>
                </tr>
            </thead>
            {{-- Asigno el valor de todos los planes agrupados a la variable collection --}}
            @php
                $collection = $planesAgrupados;
            @endphp
            {{--  --}}
            <tbody>

                <tr>
                @foreach ($categorias as $categoria)
                    
                    @if($categoria->planes()->count()>0)
                    
                        <td rowspan="{{$categoria->planes()->count()}}">
                                <a href="{{route('categorias.show',$categoria->id)}}">{{$categoria->nombre}}</a>
                        </td>
                        @foreach ($categoria->recomendaciones as $recomendacion)
                        
                            @if (!$recomendacion->planes->isEmpty())
                                <td rowspan="{{count($recomendacion->planes)}}">
                                    <a href="{{route('recomendacion.show',$recomendacion->id)}}"><i>{{$recomendacion->nombre}}</i></a>
                                </td>
                                @foreach ($recomendacion->planes as $plan)
                                <td ><a href="{{route('plan.show',$plan->id)}}">{{$plan->nombre}}</a></td>
                                <td>{{$plan->fecha_termino}}</td>
                                <td>{{$plan->completado}}</td>
                                <td>
                                    <div class="col-lg-3 center-block" style="position: relative;text-align:center;left: 30%;">
                                        <a style="color:white !important;" class="btn btn-success btn-sm" href="{{ route('plan.reporte', $plan->id) }}">
                                            <span class="fa fa-download"></span> 
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            
                            
                        @endforeach
                    @endif
                @endforeach
            
                {{-- @foreach ($collection as $loquequiera =>$planesAgrupados)
                <tr>
                    
                    <td>
                        {{$planesAgrupados[0]->recomendacion->categoria->nombre}}
                    </td>
                    @foreach ($planesAgrupados as $plan)
                        @if (!$loop->first)
                            <td></td>
                        @endif
                            <td rowspan="{{$loop->count}}">
                                {{$plan->recomendacion->nombre}}
                            </td>
                            
                            <td>
                                <a href="{{route('plan.show',$plan->id)}}">{{$plan->nombre}}</a>
                            </td>
                            <td>
                                {{$plan->fecha_termino}}
                            </td>
                            
                            @if ($plan->completado== 1)
                                <td>
                                    <p style="text-align:center">Sí</p>
                                </td>
                            @else
                                <td>
                                    <p style="text-align:center">No</p>
                                </td>
                            @endif
                            
                            <td>
                                <div class="col-lg-3 center-block" style="position: relative;text-align:center;left: 30%;">
                                    <a style="color:white !important;" class="btn btn-success btn-sm" href="{{ route('categoria.reporte', $plan->recomendacion->categoria->id) }}">
                                        <span class="fa fa-download"></span> 
                                    </a>
                                </div>
                            </td>
                            
                        </tr>
                    @endforeach
                @endforeach
                
            </tbody> --}}

        </table>
    @else
        <h3>No hay planes de acción</h3>
    @endif
@endsection
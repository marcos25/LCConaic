@extends('admin.layout')
@section('content')
<div class="container background-style">
  <title>{{$recomendacion->nombre}}</title>
        <div class="card border-0 shadow my-5">
            <div class="card-body p-5">
                <h1>Recomendación: {{$recomendacion->nombre}}</h1>
                <div class="panel panel-primary" id="result_panel">
                    {{-- @php
                        dd(isset($recomendacion->categoria->academico));
                    @endphp --}}
                    {{-- @if(isset($categoria->academico)) --}}
                    <div class="panel-heading"><h3 class="panel-title">Académicos asociado a esta recomendación : {{$recomendacion->categoria->academico->nombre}} </h3>
                    </div>
                    {{-- @else
                        <div class="panel-heading"><h3 class="panel-title">No hay ningún académico asignado a esta categoría. </h3>
                        </div>
                    @endif
                     --}}
                </div>
                <br>
                <div class="form-group " >
                        <div class="panel-heading"><h3 class="panel-title">Descripción</h3>
                    <p class="descripcion-texto">{{$recomendacion->descripcion}}</p>
                    
                </div>

                <div class="panel panel-primary" id="result_panel">
                    @if(!$planes->isEmpty())
                        @foreach ($planes as $plan)
                            <hr>
                            <div class="panel-heading"><h3 class="panel-title">Nombre del plan de acción para esta categoría: </h3>
                                <br>
                                <p> {{$plan->nombre}}</p>
                            </div>
                        @endforeach
                        
                    @else
                    
                        <div class="panel-heading"><h3 class="panel-title">No hay planes de acción asignadas para esta categoría. </h3>
                        </div>
                    @endif
                    
                </div>
                    

            <div style="height: 100px"></div>
                <p class="lead mb-0"></p>
            </div>
            {{$planes->render()}}
        </div>
    </div>
@endsection
@extends('admin.layout')
@section('content')
    <title> {{$recomendacion->nombre}} </title>
    <div class="container">
        
        <div class="row text-center">
            <div class="col-lg-12 col-md-12">
                <h1>Recomendación: {{$recomendacion->nombre}}</h1>
            </div>
        </div>

        <div class="row text-center">
            <div class="col-lg-12 col-md-12">
                <h6>Categoría: {{$recomendacion->categoria->nombre}}</h6>
            </div>
        </div>
     
        <br>
        <hr>





        <div class="card" align="center">
              <div class="card-header border-0">
                <h3 class="card-title">Lista de planes</h3>
                <div class="card-tools">
                  
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>

                    <th scope="col">Plan</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Fecha</th>
                     @if (auth()->user()->privilegio == 1) 
                    
                        <th scope="col">Acciones</th>
                    @endif
                    
                  </tr>
                  </thead>
                  <tbody>
                  
        @foreach ($planes as $plan)

                <tr>
                
                    <td><a style="color:blue !important;" href="/plan/{{$plan->id}}">{{$plan->nombre}}</a></td>

                @if ( $plan->completado == 1)
                                <td>Completado.</td>
                            @else
                                <td>En progreso.</td>
                            @endif</p>

                    <td>{{$plan->fecha_termino}}</td>
                      @if (auth()->user()->privilegio == 1) 
                    <td style="width:150px">
                        <div class="d-flex">

                           

                             <div class="d-flex">                                                               
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

              </div>


            </div>











        @if (auth()->user()->privilegio == 1) 
            <div class="row">
                <div class="col-lg-12"> 
                    <center>
                        <form action="{{ route('recomendacion.destroy',$recomendacion->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Quiere borrar la recomendación: {{ $recomendacion->nombre }}?')" >
                                Borrar recomendación <span class="fa fa-trash"></span>
                            </button>
                            <a style="color:white !important;" class="btn btn-info btn-sm" href="/recomendacion/{{$recomendacion->id}}/edit">Editar recomendación <span class="fa fa-pencil"></span></a>
                        </form>
                        
                    </center>  
                </div>
            </div>
        @endif
        @if(auth()->user()->categoria != null)
            @if(auth()->user()->categoria->id == $recomendacion->categoria->id || auth()->user()->privilegio == 1)
                <center>
                    <form action="{{ route('plan.create')}}">
                        <input type='hidden' value='{{$recomendacion->categoria->id}}' name='rec_idc'/><br>
                            <input type='hidden' value='{{$recomendacion->id}}' name='rec_id'/><br>
                            <input type='submit' class="btn btn-secondary" value='Agregar plan de acción'/>
                    </form>
                </center>
            @endif
        @endif
    </div>
    <div style="height: 100px"></div>
        <p class="lead mb-0"></p>
    </div>
@endsection
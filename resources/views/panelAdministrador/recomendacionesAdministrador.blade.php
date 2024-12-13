@extends('panelAdministrador.layouts.app')
@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Recomendaciones</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    @if (count($recomendaciones)>0)
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Categorías</th>
                                    <th scope="col">Recomendación</th>
                                    <th class="text-center" style="width: 20%;" scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recomendaciones as $recomendacion)
                                    <tr>
                                        <td>{{$recomendacion->categoria->nombre}}</td>
                                        <td>
                                            <a  href="/recomendacion/{{$recomendacion->id}}" >{{$recomendacion->nombre}}</a>
                                        </td>
                                        <td>
                                            <div class="col-lg-6 text-center">
                                                <form action="{{ route('recomendacion.destroy2',$recomendacion->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Quiere borrar la categoria: {{ $recomendacion->nombre }}?')" >
                                                        Borrar <span class="fa fa-trash"></span>
                                                    </button>
                                                </form>
                                            </div>
            
                                            <div class="col-lg-6 text-center">
                                                <a style="color:white !important;" class="btn btn-info btn-sm" href="/recomendacion/{{$recomendacion->id}}/edit">Editar <span class="fa fa-pencil"></span></a> 
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No hay recomendaciones registradas.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>

@endsection
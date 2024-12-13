<!DOCTYPE html>
<html>
<title>Reporte</title>
<head>
	<style>
		table{
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}
		td, th{
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
		}
		tr:nth-child(even){
			background-color: #dddddd;
		}
		h1{
			font-size: 300%;
		}
		h2{
			font-size: 250%;
		}
		h3{
			font-size: 200%;
		}
		.center-embed {
        	display: block;
        	margin: auto;
    	}
	</style>
</head>
<body>
		<div style="margin-top: 10%;">
        <h1 style="text-align:center"> Reporte del plan de acción: {{$plan->nombre}} </h1>
        </div>
        <div style="margin-top: 10%;">
        <h3 style="text-align:center">Descripción: {{ $plan->descripcion }}</h3>
    	</div>
        <div style="margin-top: 15%;">
        <table>
                <tr>
                    <th> Recomendación </th>
                    <th> Categoría </th>
                    <th> Estado </th>
                    <th> Fecha de término </th>
                </tr>
            <tr>
                <td> {{$plan->recomendacion->nombre}} </td>
                <td> {{$plan->categoria->nombre}} </td>
                @if($plan->completado == 0)
                    <td> En progreso </td>
                @else
                    <td> Completado </td>
                @endif
                <td> {{$plan->fecha_termino}}</td>
            </tr>
        </table>
        </div>
        <div style="margin-top: 15%;">
        <h2 style="text-align:center"> Evidencias: </h2>
    	</div>
</body>
</html>
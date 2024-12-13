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
        img{
            width: 50%;
            height: 50%;
        }
		.center-embed {
        	display: block;
        	margin: auto;
    	}
	</style>
</head>
<body>

    <div style="margin-top: 5%;">
        <center>
            <img src="Imagenes/logo_lcc.jpg">
        </center>
    </div>
	<div style="margin-top: 5%;">
        <h1 style="text-align:center"> Reporte del Área: {{$categoria->nombre}} </h1>
    </div>
    <div style="margin-top: 10%;">
        <h3 style="text-align:center">Descripción: {{ $categoria->descripcion }}</h3>
	</div>
    <div style="margin-top: 10%;">
        <h3 style="text-align:center">Encargado: {{$academico->nombre}}</h3>
    </div>
</body>
</html>
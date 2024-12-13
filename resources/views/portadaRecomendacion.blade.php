<!DOCTYPE html>
<html>
<title>Portada Recomendaciones</title>
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
		<div style="margin-top: 35%;">
            <h1 style="text-align:center"> Recomendación: {{$recomendacion->nombre}} </h1>
        </div>
        <div style="margin-top: 5%;">
            <h2 style="text-align:center">Descripción: {{ $recomendacion->descripcion }}</h2>
    	</div>
</body>
</html>
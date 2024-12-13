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
		.center-embed {
        	display: block;
        	margin: auto;
    	}
	</style>
</head>
<body>
	<?php
		if($evidencia->tipo_archivo != 'pdf'){
	?>
		<div align="center">
			<img src="{{public_path().$evidencia->archivo_bin}}" style="max-width: 100%; width: auto; height: auto;">
		</div>
	<?php
		}
	?>
<!--
	<table>
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>TIPO</th>
			<th>ARCHIVO</th>
		</tr>
	</table>
-->
</body>
</html>
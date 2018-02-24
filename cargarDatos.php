<?php 

include "classes.php";

$producto = new Producto();

//cargar los datos desde un archivo json

$datos = file_get_contents("productos.json");

$producto->guardar_datos($datos);

//cargar los datos desde una url
/*
	$url = "URL";
	$json = file_get_contents($url);

	$producto->guardar_datos(json_decode($json));
*/

header('location: productos.php');
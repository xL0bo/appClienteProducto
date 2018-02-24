<?php 

include "classes.php";

$producto = new Producto();
$cliente = new Cliente();
$clienteModel = new ClienteModel();
$relacion = new Relacion();
$columna = "";


if(!isset($_POST['tipo']) && !isset($_POST['idCliente'])){
	if(isset($_POST['columna']) && isset($_POST['datos'])){
		$columna = $_POST['columna'];
		$datos = $_POST['datos'];
	}


	switch ($columna) {
		case 'nombre':
			echo json_encode($producto->ver_datos('nombre', $datos));
			break;
		case 'codigo':
			echo json_encode($producto->ver_datos('codigo', $datos));
			break;
		case 'descripcion':
			echo json_encode($producto->ver_datos('nombre', $datos));
			break;
		case '';
			echo json_encode($producto->ver_datos());
			break;
	}	
}elseif(isset($_POST['idCliente']) && !isset($_POST['tipo'])){
	$relaciones = $relacion->guardar_relaciones($_POST['idCliente'], $_POST['datos']);

	if($relaciones){
		echo json_encode("OK");
	}else{
		echo json_encode("ERROR");
	}
}else{
	echo json_encode($clienteModel->buscar($_POST['datos']));
}




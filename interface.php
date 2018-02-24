<?php 


$cliente = new Cliente();
$clienteModel = new ClienteModel();

if(isset($_REQUEST['action'])){
	switch ($_REQUEST['action']) {
		case 'actualizar':
			$cliente->__SET('id',              $_REQUEST['id']);
                  $cliente->__SET('nombre',          $_REQUEST['nombre']);
                  $cliente->__SET('apellidos',       $_REQUEST['apellidos']);
                  $cliente->__SET('dni',             $_REQUEST['dni']);
                  $cliente->__SET('direccion', 	     $_REQUEST['direccion']);
                  $cliente->__SET('telefono', 	     $_REQUEST['telefono']);
                  $cliente->__SET('email', 	     $_REQUEST['email']);

                  $clienteModel->actualizar($cliente);
                  header('Location: clientes.php');
			break;

		case 'addCliente':
			$cliente->__SET('nombre',          $_REQUEST['nombre']);
                  $cliente->__SET('apellidos',       $_REQUEST['apellidos']);
                  $cliente->__SET('dni',             $_REQUEST['dni']);
                  $cliente->__SET('direccion', 	     $_REQUEST['direccion']);
                  $cliente->__SET('telefono', 	     $_REQUEST['telefono']);
                  $cliente->__SET('email', 	     $_REQUEST['email']);

                  $clienteModel->addCliente($cliente);
                  header('Location: clientes.php');
			break;

		case 'eliminar':
			$clienteModel->eliminar($_REQUEST['id']);
                  header('Location: clientes.php');
			break;

		case 'editar':
			$cliente = $clienteModel->obtener($_REQUEST['id']);
			break;
	}
}
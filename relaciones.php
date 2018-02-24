<?php 

include 'classes.php';

$producto = new Producto();
$cliente = new Cliente();
$clienteModel = new ClienteModel();
$relacion = new Relacion();

if(isset($_REQUEST['id'])){
	$cliente = $clienteModel->obtener($_REQUEST['id']);
}

?>
<!DOCTYPE html>
<html>
 	<?php include 'views/head.html'; ?>

<body>

 	<?php include 'views/header.html'; ?>

 	<div class="card bg-light"  style="<?php echo isset($_REQUEST['id']) ? 'display:none' : ''; ?>">
 		<div class="card-header">
			<input type="text" name="busquedaClientes" id="busquedaClientes" class="form-control" placeholder="Búsqueda mediante DNI">
		</div>
		<div class="card-body">			
			<ul class="list-group" style="height: 150px; overflow: auto;" id="listadoClientes" >
				<?php if(count($clienteModel->listar()) < 1): ?>
					<li class="list-group-item">
						<span colspan="3" align="center">No hay clientes en la base de datos.</span>
					</li>
				<?php else: ?>
					<?php foreach($clienteModel->listar() as $clie): ?>
						<li class="list-group-item">
							<a class="text-secondary" href="?id=<?php echo $clie->__GET('id'); ?>"><?php echo $clie->__GET('nombre') . ' ' . $clie->__GET('apellidos') . ' - ' . $clie->__GET('dni'); ?></a>
						</li>
					<?php endforeach; ?>
				<?php endif; ?>
			</ul>
		</div>
	</div>

	<div class="card bg-dark" style="<?php echo isset($_REQUEST['id']) ? '' : 'display:none'; ?>">
		<input type="hidden" id="id_cliente" value="<?php echo isset($_REQUEST['id']); ?>">
		<div class="card-header">
			<a type="button" class="btn btn-info btn-xs" href="relaciones.php">Buscar otro cliente</a>
		</div>
		<div class="card-body">
			<label class="text-white"><h4><?php echo $cliente->__GET('nombre') . " " . $cliente->__GET('apellidos') . " (" . $cliente->__GET('dni') . ")"; ?></h4></label>
			<ul class="list-group bg-dark listadoProductos" style="height: 650px; overflow: auto">
				<?php if(count($producto->get_all_data()) < 1): ?>
					<li class="list-group-item">
						<span colspan="3" align="center">No hay clientes en la base de datos.</span>
					</li>
				<?php else: ?>
					<?php foreach($producto->get_all_data() as $product): ?>
						<li class="list-group-item">
							<div class="custom-control custom-checkbox">
							  <input type="checkbox" class="custom-control-input chekcbox_producto" 
							  			id="producto_<?php echo $product['id']; ?>" value="<?php echo $product['id']; ?>"
							  			<?php echo (in_array($product['id'], $relacion->relaciones_cliente($_REQUEST['id']))) ? 'checked' : ''; ?>>
							  <label class="custom-control-label" for="producto_<?php echo $product['id']; ?>"><?php echo $product['nombre']."(".$product['codigo'].")"; ?></label>
							</div>
						</li>
					<?php endforeach; ?>
				<?php endif; ?>
			</ul>
		</div>
		<input type="button" class="btn btn-success" id="btnRelacionar" value="Relacionar">
	</div>

	<?php  include 'views/footer.html'; ?>

</body>

</html>

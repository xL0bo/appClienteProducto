<?php 

include 'classes.php';

$producto = new Producto();

if(isset($_GET['pagina']))
	$pagina = $_GET['pagina'];
else
	$pagina = 1;

?>
<!DOCTYPE html>
<html>

 	<?php include 'views/head.html'; ?>

<body>

 	<?php include 'views/header.html'; ?>

	<div class="card  bg-light">
		<div class="card-header"><a class="btn btn-info btn-xs" href="cargarDatos.php" title="">Cargar Datos</a></div>
		<div class="card-body">
			<table class="table table-striped table-bordered">
				<thead class="thead-dark">
					<tr>
						<th><label> Nombre </label> <input type="text" class="form-control" id="nombre"></th>
						<th><label> Código </label> <input type="text" class="form-control" id="codigo"></th>
						<th><label> Descripción </label> <input type="text" class="form-control" id="descripcion"></th>
					</tr>
				</thead>
				<tbody id="body_table">
					<?php if(count($producto->ver_datos()) < 1): ?>
						<tr>
							<td colspan="3" align="center">No hay productos en la base de datos.</td>
						</tr>
					<?php else: ?>
						<?php foreach($producto->ver_datos('', '', $pagina)['datos'] as $product): ?>
							<tr>
								<td><?php echo $product['nombre']; ?></td>
								<td><?php echo $product['codigo']; ?></td>
								<td><?php echo $product['descripcion']; ?></td>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
			</table>
			<?php include 'views/paginadorProductos.php'; ?>
		</div>
	</div>

	<?php  include 'views/footer.html'; ?>

</body>

</html>

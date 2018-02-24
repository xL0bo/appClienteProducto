<?php 

	include 'classes.php';

	$cliente = new Cliente();
	$clienteModel = new ClienteModel();

	if(isset($_GET['pagina']))
		$pagina = $_GET['pagina'];
	else
		$pagina = 1;

	include 'interface.php';
	
 ?>
<!DOCTYPE html>
<html>

 	<?php include 'views/head.html'; ?>

<body>

 	<?php include 'views/header.html'; ?>

        <div class="card bg-dark text-white">
            <div class="card-header">
                <div id="formCliente" style="<?php echo isset($_REQUEST['action']) ? '' : 'display:none'; ?>">                	
	                <form action="?action=<?php echo $cliente->id > 0 ? 'actualizar' : 'addCliente'; ?>" method="post"  >
	                    <input type="hidden" name="id" value="<?php echo $cliente->__GET('id'); ?>" />

	                    <div class="form-group row" style="position: absolute; right: 10%; <?php echo isset($_REQUEST['action']) ? 'display:none' : ''; ?>">
	                    	<button type="button" id="cerrarForm" class="close text-white" aria-label="Close" >
							  <span aria-hidden="true">&times;</span>
							</button>
	                    </div>

	                    <div class="form-group row">
		                    <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
		                    <div class="col-sm-6">
		                    	<input type="text" name="nombre" class="form-control" value="<?php echo $cliente->__GET('nombre'); ?>">
		                    </div>
		                </div>

		                <div class="form-group row">
		                    <label for="nombre" class="col-sm-2 col-form-label">Apellidos</label>
		                    <div class="col-sm-6">
		                    	<input type="text" name="apellidos" class="form-control" value="<?php echo $cliente->__GET('apellidos'); ?>">
		                    </div>
		                </div>

		                <div class="form-group row">
		                    <label for="nombre" class="col-sm-2 col-form-label">DNI</label>
		                    <div class="col-sm-6">
		                    	<input type="text" name="dni" class="form-control" value="<?php echo $cliente->__GET('dni'); ?>">
		                    </div>
		                </div>

		                <div class="form-group row">
		                    <label for="nombre" class="col-sm-2 col-form-label">Dirección</label>
		                    <div class="col-sm-6">
		                    	<input type="text" name="direccion" class="form-control" value="<?php echo $cliente->__GET('direccion'); ?>">
		                    </div>
		                </div>

		                <div class="form-group row">
		                    <label for="nombre" class="col-sm-2 col-form-label">Teléfono</label>
		                    <div class="col-sm-6">
		                    	<input type="text" name="telefono" class="form-control" value="<?php echo $cliente->__GET('telefono'); ?>">
		                    </div>
		                </div>

		                <div class="form-group row">
		                    <label for="nombre" class="col-sm-2 col-form-label">Email</label>
		                    <div class="col-sm-6">
		                    	<input type="email" name="email" class="form-control" value="<?php echo $cliente->__GET('email'); ?>">
		                    </div>
		                </div>

		                <div class="form-group row">
							<div class="col-sm-6">
								<button type="submit" class="btn btn-secondary">Guardar</button>
							</div>
						</div>
	                </form>
	            </div>
	            <div id="botonFormCliente" style="<?php echo isset($_REQUEST['action']) ? 'display: none' : ''; ?>" >
	            	<div class="form-group row">
						<div class="col-sm-6">
							<button type="button" class="btn btn-info" id="addCliente">Añadir Cliente</button>
						</div>
					</div>
	            </div>
			</div>
			<div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th >Nombre</th>
                            <th >Apellidos</th>
                            <th >DNI</th>
                            <th >Dirección</th>
                            <th >Teléfono</th>
                            <th >Email</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($clienteModel->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('nombre'); ?></td>
                            <td><?php echo $r->__GET('apellidos'); ?></td>
                            <td><?php echo $r->__GET('dni'); ?></td>
                            <td><?php echo $r->__GET('direccion'); ?></td>
                            <td><?php echo $r->__GET('telefono'); ?></td>
                            <td><?php echo $r->__GET('email'); ?></td>
                            <td>
                                <a class="btn btn-success btn-xs" href="?action=editar&id=<?php echo $r->id; ?>">Editar</a>
                            </td>
                            <td>
                                <a class="btn btn-danger btn-xs" href="?action=eliminar&id=<?php echo $r->id; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              	<?php include 'views/paginadorClientes.php'; ?>
            </div>
        </div>

	<?php  include 'views/footer.html'; ?>

</body>

</html>

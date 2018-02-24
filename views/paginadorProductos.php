<?php 
$numElementosPorPagina = 10;
$totalPaginas = ceil($producto->contador_productos()/$numElementosPorPagina);
$paginaActual = $pagina;
$desde = 0;
$hasta = 0;

		if($totalPaginas <= $numElementosPorPagina) {
			$desde = 1;
			$hasta = $totalPaginas;
		} else {
			if(paginaActual <= $numElementosPorPagina/2) {
				$desde = 1;
				$hasta = $numElementosPorPagina;
			}else if(paginaActual >= $totalPaginas - $numElementosPorPagina/2){
				$desde = $totalPaginas - $numElementosPorPagina + 1;
				$hasta = $numElementosPorPagina;
			} else {
				$desde = paginaActual - $numElementosPorPagina/2;
				$hasta = $numElementosPorPagina;
			}
		}
?>
		<nav>
			<ul class="pagination">
				<li >
					<a href="productos.php" class="page-link">Primera</a>
				</li>

				<li>
					<a href="productos.php?pagina=<?php echo ($pagina == 1) ? '1' : ($pagina-1) ?>" class="page-link" >&laquo;</a>
				</li>
				<?php for($i = 0; $i < $hasta; $i++): ?>
					<li> 
						<a href="productos.php?pagina=<?php echo $i+1; ?>"  class="page-link"><?php echo $i+1; ?></a>
					</li>
				<?php endfor; ?>
				<li> 
					<a href="productos.php?pagina=<?php echo ($pagina == $hasta) ? $pagina : ($pagina+1); ?>"  class="page-link">&raquo;</a>
				</li>

				<li>
					<a href="productos.php?pagina=<?php echo $hasta; ?>" class="page-link">&Uacute;ltima</a>
				</li>
			</ul>
		</nav>		
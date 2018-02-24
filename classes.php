<?php 

class Conexion extends PDO{

	private $nombre_de_base = 'pruebaIndra';
	private $usuario = 'root';
	private $contrasena = ''; 

	public function __construct() {
      //Sobreescribo el método constructor de la clase PDO.
      try{
         parent::__construct('mysql:host=localhost;dbname='.$this->nombre_de_base, $this->usuario, $this->contrasena, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
      }catch(PDOException $e){
         echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
         exit;
      }
   	}

}

class Producto{

	private $conexion;

	public $id;
	public $nombre;
	public $codigo;
	public $descripcion;

	public function __construct(){
		$this->conexion = new Conexion();
	}

	public function guardar_datos($json_datos){
		foreach(json_decode($json_datos, true) as $producto){
			$this->nombre = $producto['nombre'];
			$this->codigo = $producto['codigo'];
			$this->descripcion = $producto['descripcion'];

			$this->conexion->query('INSERT INTO productos (nombre, codigo, descripcion) VALUES ("'.$this->nombre.'", "'.$this->codigo.'", "'.$this->descripcion.'")');

			if(!$this->conexion->lastInsertId()){
				return false;
			}
		}
		$conexion = null;
	}

	public function ver_datos($columna = "", $filtro = "", $pagina = 1){
		$datos = array();
		$mediante_filtros = "";
		$paginacion = "";
		$maximo = 10; 

		if($columna != "" && $filtro != ""){
			$mediante_filtros = 'WHERE '.$columna.' LIKE "%'. $filtro .'%"';
		}

		if($pagina == 1){			
			$minimo = 0; 
		}else{
			$minimo = $maximo * $pagina;
            $minimo = $minimo - $maximo;
		}

		$paginacion = " LIMIT ".$minimo.", ".$maximo."";
		

		$sql = 'SELECT * FROM productos '.$mediante_filtros.$paginacion;
		
		foreach($this->conexion->query($sql) as $row){
			$datos[] = array(
								'nombre' => $row['nombre'],
								'codigo' => $row['codigo'],
								'descripcion' => $row['descripcion']
							);
		}

		$datos['datos'] = $datos;
		$datos['pagina'] = $pagina;
		

		return $datos;
	}

	public function contador_productos(){

		$sql = $this->conexion->prepare("SELECT * FROM productos");
		$sql->execute();

		$total = $sql->rowCount();

		return $total;
	}

	public function get_all_data(){

		$datos = array();

		$sql = $this->conexion->prepare("SELECT * FROM productos");
		$sql->execute();

		foreach($sql->fetchAll(PDO::FETCH_OBJ) as $producto){
			$datos[] = array(
								'id' => $producto->id,
								'nombre' => $producto->nombre,
								'codigo' => $producto->codigo,
								'descripcion' => $producto->descripcion
							);
		}

		return $datos;
	}


}


 class Cliente{

 	public $id;
 	public $nombre;
 	public $apellidos;
 	public $dni;
 	public $direccion;
 	public $telefono;
 	public $email;

 	public function __GET($k){ return $this->$k; }
 	public function __SET($k, $v){ return $this->$k = $v; }
 }

 class ClienteModel{

 	private $conexion;

 	public function __construct(){
 		$this->conexion = new Conexion();
 	}

 	public function listar(){
 		try{
 			$datos = array();

 			$sql = $this->conexion->prepare("SELECT * FROM clientes");
 			$sql->execute();

 			foreach($sql->fetchAll(PDO::FETCH_OBJ) as $cliente){
 				$cli = new Cliente();

 				$cli->__SET('id', $cliente->id);
 				$cli->__SET('nombre', $cliente->nombre);
 				$cli->__SET('apellidos', $cliente->apellidos);
 				$cli->__SET('dni', $cliente->dni);
 				$cli->__SET('direccion', $cliente->direccion);
 				$cli->__SET('telefono', $cliente->telefono);
 				$cli->__SET('email', $cliente->email);

 				$datos[] = $cli;
 			}

 			return $datos;

 		}catch(Exception $e){
 			die($e->getMessage);
 		}
 	}

 	public function obtener($id){
 		try{

 			$sql = $this->conexion->prepare("SELECT * FROM clientes WHERE id = ?");
 			$sql->execute(array($id));

 			$cliente = $sql->fetch(PDO::FETCH_OBJ);

 			$cli = new Cliente();

			$cli->__SET('id', $cliente->id);
			$cli->__SET('nombre', $cliente->nombre);
			$cli->__SET('apellidos', $cliente->apellidos);
			$cli->__SET('dni', $cliente->dni);
			$cli->__SET('direccion', $cliente->direccion);
			$cli->__SET('telefono', $cliente->telefono);
			$cli->__SET('email', $cliente->email);

			return $cli;
 		}catch(Exception $e){
 			die($e->getMessage());
 		}
 	}

 	public function eliminar($id){
 		try{

 			$sql = $this->conexion->prepare("DELETE FROM clientes WHERE id = ?");
 			$sql->execute(array($id));

 		}catch(Exception $e){
 			die($e->getMessage());
 		}
 	}

 	public function actualizar(Cliente $datos){
 		try{

 			$sql = "UPDATE clientes SET
 						nombre = 	?,
 						apellidos = ?,
 						dni = 		?,
 						direccion = ?,
 						telefono =  ?,
 						email =     ?
 					WHERE id = ?";
 			$this->conexino->prepare($sql)->execute(
 				array(
 						$datos->__GET('nombre'),
 						$datos->__GET('apellidos'),
 						$datos->__GET('dni'),
 						$datos->__GET('direccion'),
 						$datos->__GET('telefono'),
 						$datos->__GET('email')
 					)
 			);
 		}catch(Exception $e){
 			die($e->getMessage());
 		}
 	}

 	public function addCliente(Cliente $datos){
 		try{
 			$sql = "INSERT INTO clientes (nombre, apellidos, dni, direccion, telefono, email)
 					VALUES (?, ?, ?, ?, ?, ?)";

 			$this->conexion->prepare($sql)->execute(
 				array(
 						$datos->__GET('nombre'),
 						$datos->__GET('apellidos'),
 						$datos->__GET('dni'),
 						$datos->__GET('direccion'),
 						$datos->__GET('telefono'),
 						$datos->__GET('email')
 					)
 			);
 		}catch(Exception $e){
 			die($e->getMessage());
 		}
 	}

 	public function buscar($dni){
 		try{
 			$datos = array();

 			$sql = $this->conexion->prepare("SELECT * FROM clientes WHERE dni LIKE ?");
 			$sql->execute(array('%'.$dni.'%'));

 			foreach($sql->fetchAll(PDO::FETCH_OBJ) as $cliente){
 				$cli = new Cliente();

 				$cli->__SET('id', $cliente->id);
 				$cli->__SET('nombre', $cliente->nombre);
 				$cli->__SET('apellidos', $cliente->apellidos);
 				$cli->__SET('dni', $cliente->dni);
 				$cli->__SET('direccion', $cliente->direccion);
 				$cli->__SET('telefono', $cliente->telefono);
 				$cli->__SET('email', $cliente->email);

 				$datos[] = $cli;
 			}

 			return $datos;

 		}catch(Exception $e){
 			die($e->getMessage);
 		}
 	}

 }

 class Relacion{

 	private $conexion;

 	public $idCliente;
 	public $idProducto;

 	public function __construct(){
		$this->conexion = new Conexion();
	}

	public function guardar_relaciones($idCliente, $datos){

		//primero eliminamos los registros del cliente
		$sql = $this->conexion->prepare("DELETE FROM relaciones WHERE idCliente = ?");
		$sql->execute(array($idCliente));

		//despues añadimos todas las relaciones
		if(count($datos) > 0){
			foreach(json_decode($datos) as $relacion){
				$sql = "INSERT INTO relaciones (idCliente, idProducto)
 					VALUES (?, ?)";
 				$this->conexion->prepare($sql)->execute(
	 				array(
	 						$idCliente,
	 						$relacion
	 					)
	 			);

	 			if(!$this->conexion->lastInsertId()){
					return false;
				}
			}
			return true;
		}
		return false;
	}

	public function relaciones_cliente($idCliente){

		$datos = array();

		$sql = $this->conexion->prepare("SELECT * FROM relaciones WHERE idCliente = ?");
		$sql->execute(array($idCliente));

		foreach($sql->fetchAll(PDO::FETCH_OBJ) as $producto){
			array_push($datos, $producto->idProducto);
		}

		return $datos;
	}
 }
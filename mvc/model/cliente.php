<?php 

class Cliente {

	private $table = 'Cliente';
	private $conection;

	public function __construct() {
		
	}

	public function countByNegocio($id){
		if(is_null($id)) return false;
		$this->getConection();
		$sql = "SELECT COUNT(*) FROM ".$this->table. " WHERE id_negocio = ?";
		$stmt = $this->conection->prepare($sql);
		$stmt->execute([$id]);
		$count = $stmt->fetch();
		return $count[0];
	}
	/* Set conection */
	public function getConection(){
		$dbObj = new Db();
		$this->conection = $dbObj->conection;
	}

	/* Get all Clientes */
	public function getClientes(){
		$this->getConection();
		$sql = "SELECT * FROM ".$this->table;
		$stmt = $this->conection->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}
	
	/* Get cliente by id */
	public function getClienteById($id){
		if(is_null($id)) return false;
		$this->getConection();
		$sql = "SELECT * FROM ".$this->table. " WHERE ID_Cliente = ?";
		$stmt = $this->conection->prepare($sql);
		$stmt->execute([$id]);

		return $stmt->fetch();
	}

	/* Obtener todos los clientes por negocio */
	public function getClientesByNegocio($id){
		if(is_null($id)) return false;
		$this->getConection();
		
		if (isset($_GET["pagina"])){
			$page  = $_GET["pagina"]; 
		}else{
			$page = constant("DEFAULT_PAGE");
		}

		$count=0;
		$start_from = ($page-1) * constant("DEFAULT_RESULT_PER_PAGE");
		
		$sql = "SELECT COUNT(*) FROM ".$this->table. " WHERE id_negocio = ?";
		$stmt = $this->conection->prepare($sql);
		$stmt->execute([$id]);
		$count = $stmt->fetch();

		$sql = "SELECT * FROM ".$this->table. " WHERE id_negocio = ? LIMIT $start_from, ".constant("DEFAULT_RESULT_PER_PAGE");
		$stmt = $this->conection->prepare($sql);
		$stmt->execute([$id]);
		$fetch = $stmt->fetchAll();
		$pages = ceil($count[0] / constant("DEFAULT_RESULT_PER_PAGE"));

		return array('fetch'=> $fetch, 'paginas' => $pages);
	}

	/* Guardar producto nuevo */
	public function save($param){
		$this->getConection();

		/* Set default values */
		$nombre = $apellido = $direccion = $telefono = "";
		
		$param = array_merge($param, ['id' => $param["id"]==0 ? null : $param["id"] , "id_negocio" => $_SESSION['usuario']['id_negocio'] ]);

		/* Check if exists */
		$exists = false;
		if(isset($param["id"]) and trim($param["id"]) !=''){
			$actualCliente = $this->getClienteById($param["id"]);
			if(isset($actualCliente["ID_Cliente"])){
				$exists = true;	
				/* Actual values */
				$id = $param["id"];
				$nombre = $actualCliente['Nombre'];
				$apellido = $actualCliente['Apellido'];
				$direccion = $actualCliente['Direccion'];
				$telefono = $actualCliente['Telefono'];
				$email = $actualCliente['email'];
				$contra = $actualCliente['contra'];
				$usuario = $actualCliente['usuario'];
				$id_negocio = $param['id_negocio'];
			}
		}

		/* Received values */
		if(isset($param["id"])) $id = $param['id'];
		if(isset($param["nombre"])) $nombre = $param['nombre'];
		if(isset($param["apellido"])) $apellido = $param['apellido'];
		if(isset($param["direccion"])) $direccion = $param['direccion'];
		if(isset($param["telefono"])) $telefono = $param['telefono'];

		if(isset($param["email"])) $email = $param['email'];
		if(isset($param["pass"])) $contra = $param['pass'];
		if(isset($param["user"])) $usuario = $param['user'];

		if(isset($param["id_negocio"])) $id_negocio = $param['id_negocio'];
		
		/* Database operations */
		if($exists){
			$sql = "UPDATE ".$this->table. " SET Nombre=?, Apellido=?, Direccion=?, Telefono=?, email=?, contra=?, usuario=? WHERE ID_Cliente=?";
			$stmt = $this->conection->prepare($sql);
			$res = $stmt->execute([$nombre, $apellido, $direccion, $telefono, $email, $contra, $usuario, $id]);
		}else{
			$sql = "INSERT INTO ".$this->table. " (`ID_Cliente`, `Nombre`, `Apellido`, `Direccion`, `Telefono`, `email`, `contra`, `usuario`, `id_negocio`) 
			VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?);";
			$stmt = $this->conection->prepare($sql);
			try {
			    $stmt->execute([$nombre, $apellido, $direccion, $telefono, $email, $contra, $usuario, $id_negocio]);
			    $id = $this->conection->lastInsertId();
			}
			catch (exception $e) {
			    $id=$e->getCode();
			}
		}
		return $id;
	}

	/* Borrar cliente */
	public function deleteClienteById($id){
		$this->getConection();
		$sql = "DELETE FROM ".$this->table. " WHERE ID_Cliente = ?";
		$stmt = $this->conection->prepare($sql);
		return $stmt->execute([$id]);
	}
}

?>
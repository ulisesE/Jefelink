<?php 
class Producto {

	private $table = 'Producto';
	private $conection;

	public function __construct() {
		
	}

	/* Set conection */
	public function getConection(){
		$dbObj = new Db();
		$this->conection = $dbObj->conection;
	}

	/* Obtener todos los productos */
	public function getDatos(){
		$this->getConection();
		$sql = "SELECT * FROM ".$this->table;
		$stmt = $this->conection->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll();
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
	/* Get obtener todos los productos de ese negocio*/
	public function getProductosByNegocio($id){
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

	/* Get obtener producto by id*/
	public function getProductosById($id){
		if(is_null($id)) return false;
		$this->getConection();

		$sql = "SELECT * FROM ".$this->table. " WHERE ID_Producto = ? ";
		$stmt = $this->conection->prepare($sql);
		$stmt->execute([$id]);
		
		return $stmt->fetch();
	}

	/* Guardar producto nuevo */
	public function save($param){
		$this->getConection();

		/* Set default values */
		$nombre = $nombreCorto = $descripcion = $descripcionCorta = $img = "";
		$precio = $cantidad = 0;
		
		$param = array_merge($param, ['id' => $param["id"]==0 ? null : $param["id"]  , "id_negocio" => $_SESSION['usuario']['id_negocio'] ]);
		/* Check if exists */
		$exists = false;
		if(isset($param["id"]) and trim($param["id"]) !=''){
			$actualProducto = $this->getProductosById($param["id"]);
			if(isset($actualProducto["ID_Producto"])){
				$exists = true;	
				/* Actual values */
				$id = $param["id"];
				
				$nombre = $actualProducto['Nombre'];
				$nombreCorto = $actualProducto['NombreCorto'];
				$descripcion = $actualProducto['Descripcion'];
				$descripcionCorta = $actualProducto['DescripcionCorta'];
				$precio = $actualProducto['Precio'];
				$img = $actualProducto['img'];
				$cantidad = $actualProducto["Cantidad"];
				
				$id_negocio = $param['id_negocio'];
			}
		}

		/* Received values */
		if(isset($param["nombre"])) $nombre = $param['nombre'];
		if(isset($param["nombreCorto"])) $nombreCorto = $param['nombreCorto'];
		if(isset($param["descripcion"])) $descripcion = $param['descripcion'];
		if(isset($param["descripcionCorta"])) $descripcionCorta = $param['descripcionCorta'];
		if(isset($param["precio"])) $precio = $param['precio'];
		if(isset($param["img"])) $img = $param['img']==0? $actualProducto['img'] : $param["img"];
		if(isset($param["id_negocio"])) $id_negocio = $param['id_negocio'];
		if(isset($param["cantidad"])) $cantidad = $param["cantidad"];

		/* Database operations */
		if($exists){
			$sql = "UPDATE ".$this->table. " SET Nombre=?, NombreCorto=?, Descripcion=?, DescripcionCorta=?,Precio=?, img=?,cantidad=? WHERE ID_Producto=?";
			$stmt = $this->conection->prepare($sql);
			$res = $stmt->execute([$nombre, $nombreCorto, $descripcion, $descripcionCorta, $precio, $img, $cantidad, $id]);
		}else{
			$sql = "INSERT INTO ".$this->table. " (ID_Producto, Nombre, NombreCorto, Descripcion, DescripcionCorta, Precio, status, img, cantidad, id_negocio) 
			values(null, ?, ?, ?, ?, ?, 'A', ?, ?, ?)";
			$stmt = $this->conection->prepare($sql);
			$stmt->execute([$nombre, $nombreCorto, $descripcion, $descripcionCorta, $precio, $img, $cantidad, $id_negocio]);
			$id = $this->conection->lastInsertId();
		}
		
		
		return $id;
	}

	/* Cambiar estatus de producto */
	public function cambiarEstatus($param){
		$this->getConection();
		print_r($param);
		/* Check if exists */
		$exists = false;
		if(isset($param["idProd"]) and $param["idProd"] !=''){
			$actualProducto = $this->getProductosById($param["idProd"]);
			$actualProducto['status']=($param['estatus']=='true')?'A':'I';
		}
		
		$sql = "UPDATE ".$this->table. " SET status=? WHERE ID_Producto=?";
		$stmt = $this->conection->prepare($sql);
		$res = $stmt->execute([$actualProducto['status'], $param["idProd"]]);
		print_r($actualProducto);
		//return $res;
	}

	/* Borrar prodcuto */
	public function deleteProductoById($id){
		$this->getConection();
		$sql = "DELETE FROM ".$this->table. " WHERE ID_Producto = ?";
		$stmt = $this->conection->prepare($sql);
		return $stmt->execute([$id]);
	}

}

?>
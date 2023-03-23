<?php 

class Datos {

	private $table = 'datos';
	private $conection;

	public function __construct() {
		
	}

	/* Set conection */
	public function getConection(){
		$dbObj = new Db();
		$this->conection = $dbObj->conection;
	}

	/* Get all notes */
	public function getDatos(){
		$this->getConection();
		$sql = "SELECT * FROM ".$this->table;
		$stmt = $this->conection->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll();
	}

	/* Get note by id */
	public function getDatosById($id){
		if(is_null($id)) return false;
		$this->getConection();
		$sql = "SELECT * FROM ".$this->table. " WHERE id_negocio = ?";
		$stmt = $this->conection->prepare($sql);
		$stmt->execute([$id]);

		return $stmt->fetch();
	}

	/* Get note by id */
	public function validaDatos($params){
		if(is_null($params['email'])) return false;
		if(is_null($params['password'])) return false;
		$correo = $params['email'];
		$pass = $params['password'];
		$this->getConection();
		$sql = "SELECT * FROM ".$this->table. " WHERE correo like \"$correo\" AND contrase like \"$pass\" ";
		$stmt = $this->conection->prepare($sql);
		$stmt->execute();
		return $stmt->fetch();
	}

}

?>
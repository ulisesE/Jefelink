<?php 

class Empleado {

	private $table = 'Empleado';
	private $conection;

	public function __construct() {
		
	}

	/* Set conection */
	public function getConection(){
		$dbObj = new Db();
		$this->conection = $dbObj->conection;
	}

	/* Get all notes */
	public function getEmpleados(){
		$this->getConection();
		$sql = "SELECT * FROM ".$this->table;
		$stmt = $this->conection->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll();
	}

	/* Get note by id */
	public function getEmpleadosByNegocio($id){
		if(is_null($id)) return false;
		$this->getConection();
		$sql = "SELECT * FROM ".$this->table. " WHERE id_negocio = ?";
		$stmt = $this->conection->prepare($sql);
		$stmt->execute([$id]);
		return $stmt->fetch();
	}
}

?>
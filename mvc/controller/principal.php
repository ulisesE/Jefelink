<?php 
require_once 'model/datos.php';
require_once 'model/producto.php';
require_once 'model/empleado.php';
require_once 'model/cliente.php';
class principalController{
	public $page_title;
	public $view;

	public function __construct() {
		$this->view = 'template/login';
		$this->page_title = 'Inicio';
		$this->datosObj = new Datos();
		$this->productosObj = new Producto();
		$this->empleadoObj = new Empleado();
		$this->clientesObj = new Cliente();
	}

	/* List all notes */
	public function principal(){
		if (isset($_SESSION['usuario']) && $_SESSION['usuario']!=null) {
				$this->page_title = 'panelAdmin';
				$this->view = 'panel/inicio';
				$_GET['countProducts'] = $this->productosObj->countByNegocio($_SESSION['usuario']['id_negocio']);
				$_GET['countClientes'] = $this->clientesObj->countByNegocio($_SESSION['usuario']['id_negocio']);
				return true;
		}
		$this->page_title = 'login';
		$this->view = 'template/login';
		return true;
	}

	public function productos(){
		$this->page_title = 'productos';
		$this->view = 'panel/productos';
		return $this->productosObj->getDatosByNegocio($_SESSION['usuario']['id_negocio']);
	}

	/* List all notes */
	public function login(){
		$obj = $this->datosObj->validaDatos($_POST);
		if ($obj) {
			$obj = $this->datosObj->getDatosById($obj['id_negocio']);
			$obj = array_merge($obj,$this->empleadoObj->getEmpleadosByNegocio($obj['id_negocio']));
			$_SESSION['usuario'] = $obj;
		}else{
			$_SESSION['usuario'] = [];
		}
		header("location: /index.php");
		return false;
	}
	/* List all notes */
	public function logout(){
		session_unset();
		session_destroy();
		//header("location: /index.php");
		return false;
	}

	/* Create or update note */
	public function save(){
		$this->view = 'edit_note';
		$this->page_title = 'Editar nota';
		$id = $this->datosObj->save($_POST);
		$result = $this->datosObj->getNoteById($id);
		$_GET["response"] = true;
		return $result;
	}

	/* Confirm to delete */
	public function confirmDelete(){
		$this->page_title = 'Eliminar nota';
		$this->view = 'confirm_delete_note';
		return $this->datosObj->getNoteById($_GET["id"]);
	}

	/* Delete */
	public function delete(){
		$this->page_title = 'Listado de notas';
		$this->view = 'delete_note';
		return $this->datosObj->deleteNoteById($_POST["id"]);
	}

}

?>
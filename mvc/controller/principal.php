<?php 
require_once 'model/datos.php';
class principalController{
	public $page_title;
	public $view;

	public function __construct() {
		$this->view = 'template/login';
		$this->page_title = '';
		$this->noteObj = new Datos();
	}

	/* List all notes */
	public function principal(){
		if (isset($_SESSION['usuario']) && $_SESSION['usuario']!=null) {
			$this->page_title = 'panelAdmin';
			$this->view = 'panel/inicio';
		}else{
			$this->page_title = 'login';
			$this->view = 'template/login';
		}
		return true;
	}

	/* List all notes */
	public function login(){
		//$this->page_title = 'Iniciando Sesion';
		//$this->view = 'panelAdmin';
		/* Id can from get param or method param */
		$obj = $this->noteObj->validaDatos($_POST);
		$obj = $this->noteObj->getDatosById($obj['id']);
		$_SESSION['usuario'] = $obj;
		header("location: /index.php");
		return false;
	}
	/* List all notes */
	public function logout(){
		//$this->page_title = 'Cerrando sesion';
		//$this->view = 'panelAdmin';
		session_unset();
		session_destroy();
		header("location: /index.php");
		return false;
	}

	/* Create or update note */
	public function save(){
		$this->view = 'edit_note';
		$this->page_title = 'Editar nota';
		$id = $this->noteObj->save($_POST);
		$result = $this->noteObj->getNoteById($id);
		$_GET["response"] = true;
		return $result;
	}

	/* Confirm to delete */
	public function confirmDelete(){
		$this->page_title = 'Eliminar nota';
		$this->view = 'confirm_delete_note';
		return $this->noteObj->getNoteById($_GET["id"]);
	}

	/* Delete */
	public function delete(){
		$this->page_title = 'Listado de notas';
		$this->view = 'delete_note';
		return $this->noteObj->deleteNoteById($_POST["id"]);
	}

}

?>
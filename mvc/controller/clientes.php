<?php 
require_once 'model/cliente.php';
class clientesController{
	public $page_title;
	public $view;

	public function __construct() {
		$this->view = 'panel/clientes';
		$this->page_title = '';
		$this->clienteObj = new Cliente();
	}

	public function principal(){
		$this->page_title = 'clientes';
		$this->view = 'panel/clientes';
		return $this->clienteObj->getClientesByNegocio($_SESSION['usuario']['id_negocio']);
	}
	/* Create or update cliente */
	public function save(){
		$id = $this->clienteObj->save($_POST);
		$result = $this->clienteObj->getClienteById($id);
		if ($result) {
			Redirect('/index.php?controller=clientes&response=true', false);
		}else{
			Redirect('/index.php?controller=clientes&response=-'.$id, false);
		}
	}
	/* Confirm to delete */
	public function confirmDelete(){
		$this->page_title = 'Eliminar Producto';
		$this->view = 'confirm_delete_';
		$result = $this->clienteObj->getClienteById($_GET["id"]);
		if ($result==null) { header('location: index?controller=clientes'); }
		return $this->clienteObj->getClienteById($_GET["id"]);
	}

	/* Delete */
	public function delete(){
		$this->page_title = 'Listado de notas';
		$this->clienteObj->deleteClienteById($_POST["id"]);
		header('location: index?controller=clientes');
	}
}

?>
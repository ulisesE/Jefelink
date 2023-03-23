<?php 
require_once 'model/producto.php';
class productosController{
	public $page_title;
	public $view;

	public function __construct() {
		$this->view = 'panel/productos';
		$this->page_title = '';
		$this->productosObj = new Producto();
	}

	public function principal(){
		$this->page_title = 'productos';
		$this->view = 'panel/productos';
		return $this->productosObj->getProductosByNegocio($_SESSION['usuario']['id_negocio']);
	}

	/* Create or update note */
	public function save(){
		$id = $this->productosObj->save($_POST);
		$result = $this->productosObj->getProductosById($id);
		$_GET["response"] = true;
		Redirect('/index.php?controller=productos&response=true', false);
	}

	public function traerIMG(){
		$idImg = $_GET["id"];
		$result = $this->productosObj->getProductosById($idImg);
		$str=$result['img'];		
		file_put_contents('foo.png', base64_decode($str));
		header('Content-Type: image/png');
		echo base64_decode($str);
	}
	/* Create or update note */
	public function cambiarEstatus(){
		//$this->view = 'Cambiando estatus de producto';
		$this->page_title = 'Cambiando estatus de producto';
		$id = $this->productosObj->cambiarEstatus($_POST);
		$result = $this->productosObj->getProductosById($id);
		$_GET["response"] = true;
		return $result;
	}

	/* Confirm to delete */
	public function confirmDelete(){
		$this->page_title = 'Eliminar Producto';
		$this->view = 'confirm_delete_';
		return $this->productosObj->getProductosById($_GET["id"]);
	}

	/* Delete */
	public function delete(){
		$this->page_title = 'Listado de notas';
		$this->productosObj->deleteProductoById($_POST["id"]);
		header('location: index?controller=productos');
	}

}

?>
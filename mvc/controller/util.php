<?php 
require_once 'model/datos.php';
require_once 'model/producto.php';
require_once 'model/empleado.php';
class utilController{
	public $page_title;
	public $view;

	public function __construct() {
		$this->view = 'template/login';
		$this->page_title = '';
		$this->datosObj = new Datos();
		$this->productosObj = new Producto();
		$this->empleadoObj = new Empleado();
	}

	/* List all notes */
	public function validaSession($obj){
		if (isset($_SESSION['usuario']) && $_SESSION['usuario']!=null) {
			$obj = $this->datosObj->getDatosById($obj);
			$obj = array_merge($obj,$this->empleadoObj->getEmpleadosByNegocio($obj['id_negocio']));
			if ($_SESSION['usuario'] == $obj) {
				return true;
			}
		}
		return false;
	}

	/* List all notes */
	public function cambiarToggleNav(){
		$_SESSION['navToggle'] = $_SESSION['navToggle']=='true' ? 'false' : 'true';
		$this->view = '';
		$this->page_title = '';
		echo $_SESSION['navToggle'];
		return false;
	}
	
}
?>
<?php 
session_start();
require_once 'config/config.php';
require_once 'model/db.php';
require_once 'controller/util.php';

$validationCTRL = new utilController();

if(!isset($_GET["controller"])) $_GET["controller"] = constant("DEFAULT_CONTROLLER");
if(!isset($_GET["action"])) $_GET["action"] = constant("DEFAULT_ACTION");
if(!isset($_SESSION['navToggle'])) $_SESSION['navToggle'] = 'true';
if ($_GET["controller"]=='principal' && ($_GET["action"]=='login' || $_GET["action"]=='principal' || $_GET["action"]=='logout')) {

}else{
	$val = $validationCTRL->validaSession($_SESSION['usuario']['id_negocio']);
	if(!$val){
		$_GET["controller"] = constant("DEFAULT_CONTROLLER");
		$_GET["action"] = constant("DEFAULT_ACTION");
	}
}

$controller_path = 'controller/'.$_GET["controller"].'.php';

/* Check if controller exists */
if(!file_exists($controller_path)) $controller_path = 'controller/'.constant("DEFAULT_CONTROLLER").'.php';

/* Load controller */
require_once $controller_path;
$controllerName = $_GET["controller"].'Controller';
$controller = new $controllerName();

/* Check if method is defined */
$dataToView["data"] = array();
if(method_exists($controller,$_GET["action"])) $dataToView["data"] = $controller->{$_GET["action"]}();

if ($_GET["action"]!='traerIMG') {
/* Load views */
require_once 'view/template/loader.html';
require_once 'view/template/header.php';
require_once 'view/'.$controller->view.'.php';
require_once 'view/template/footer.php';
}
?>
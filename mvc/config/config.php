<?php
/* Database connection values */
//define("DB_HOST", 'localhost');
define("DB_HOST", '212.1.209.193');
define("DB", 'u290360044_pixels');
define("DB_USER", 'u290360044_lonko');
define("DB_PASS", 'lG+$IbNxx9');

/* Default options */
define("DEFAULT_CONTROLLER", "principal");
define("DEFAULT_ACTION", "principal");
define("DEFAULT_TOGGLE", true);
define("DEFAULT_PAGE", 1);
define("DEFAULT_RESULT_PER_PAGE", 15);

function Redirect($url, $permanent = false){
  header('Location: ' . $url, true, $permanent ? 301 : 302);
  exit();
}
?>
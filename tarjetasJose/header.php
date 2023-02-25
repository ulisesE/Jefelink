<!DOCTYPE html>
<?php
    include 'db.php';
    session_start();
    $arry = explode('/',$_SERVER[REQUEST_URI]);
    if(end($arry) != 'index.php'){
        if( !isset($_SESSION['auth']) && $_SESSION['auth']){
            $newURL = 'index.php';
            header('Location: '.$newURL);
        }
    }
?>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
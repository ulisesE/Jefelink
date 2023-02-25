<?php
    include 'db.php';
    $newURL = 'index.php';
    if($_GET['pswd']=='1234'){
        $_SESSION["auth"] = true;
        $newURL = 'menu.php';
    }else{
        $_SESSION["auth"] = false;
    }
    header('Location: '.$newURL);
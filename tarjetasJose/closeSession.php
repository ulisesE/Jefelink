<?php
// remove all session variables
session_unset();

// destroy the session
session_destroy();
$newURL = 'index.php';
header('Location: '.$newURL);
?>
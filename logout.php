<?php
session_start();
$_SESSION = [];
session_destroy();
header('Location: /Biblioteca_php/login.php');
exit;
?>

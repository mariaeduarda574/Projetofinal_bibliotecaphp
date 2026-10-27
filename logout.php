<?php
session_start();
$_SESSION = [];
session_destroy();
header('Location: /projetofinal_bibliotecaphp/login.php');
exit;
?>

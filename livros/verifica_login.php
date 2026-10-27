<?php
if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /projetofinal_bibliotecaphp/login.php');
    exit;
}
?>

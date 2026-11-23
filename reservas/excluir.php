
<?php
require __DIR__ . '/../livros/verifica_login.php';
require __DIR__ . '/../conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: listar.php');
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$reserva_id = filter_input(INPUT_POST, 'reserva_id', FILTER_VALIDATE_INT);

if (!$reserva_id || $reserva_id <= 0) {
    header('Location: listar.php');
    exit;
}

$sql = "DELETE FROM reservas
        WHERE id = ? AND usuario_id = ?";

$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, 'ii', $reserva_id, $usuario_id);
mysqli_stmt_execute($stmt);

header('Location: listar.php');
exit;
?>

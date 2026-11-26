
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
    $_SESSION['mensagem'] = 'ID da reserva inválido.';
    $_SESSION['tipo_mensagem'] = 'error';

    header('Location: listar.php');
    exit;
}

$sql = "DELETE FROM reservas
        WHERE id = ? AND usuario_id = ?";

$stmt = mysqli_prepare($conexao, $sql);

if ($stmt) {

    mysqli_stmt_bind_param($stmt, 'ii', $reserva_id, $usuario_id);

    if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) > 0) {
        $_SESSION['mensagem'] = 'Reserva removida com sucesso!';
        $_SESSION['tipo_mensagem'] = 'success';
    } else {
        $_SESSION['mensagem'] = 'Reserva não encontrada ou não pôde ser removida.';
        $_SESSION['tipo_mensagem'] = 'error';
    }

    mysqli_stmt_close($stmt);

} else {
    $_SESSION['mensagem'] = 'Não foi possível preparar a exclusão da reserva.';
    $_SESSION['tipo_mensagem'] = 'error';
}

header('Location: listar.php');
exit;
?>

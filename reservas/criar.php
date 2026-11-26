
<?php
session_start();

require __DIR__ . '/../conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuario_id = $_SESSION['usuario_id'];
    $livro_id = filter_input(INPUT_POST, 'livro_id', FILTER_VALIDATE_INT);

    if (!$livro_id || $livro_id <= 0) {
        $_SESSION['mensagem'] = 'Livro inválido.';
        $_SESSION['tipo_mensagem'] = 'error';
        header('Location: ../livros/listar.php');
        exit;
    }

    // Verifica se o livro existe e possui exemplares
    $sql = "SELECT quantidade FROM livros WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);

    if (!$stmt) {
        $_SESSION['mensagem'] = 'Não foi possível consultar o livro.';
        $_SESSION['tipo_mensagem'] = 'error';
        header('Location: ../livros/listar.php');
        exit;
    }

    mysqli_stmt_bind_param($stmt, 'i', $livro_id);
    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);
    $livro = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($stmt);

    if (!$livro) {
        $_SESSION['mensagem'] = 'Livro não encontrado.';
        $_SESSION['tipo_mensagem'] = 'error';

    } elseif ((int) $livro['quantidade'] <= 0) {
        $_SESSION['mensagem'] = 'Esse livro não possui exemplares disponíveis.';
        $_SESSION['tipo_mensagem'] = 'error';

    } else {

        // Registra a reserva
        $sql = "INSERT INTO reservas (usuario_id, livro_id)
                VALUES (?, ?)";

        $stmt = mysqli_prepare($conexao, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param(
                $stmt,
                'ii',
                $usuario_id,
                $livro_id
            );

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['mensagem'] = 'Reserva realizada com sucesso!';
                $_SESSION['tipo_mensagem'] = 'success';
            } else {
                $_SESSION['mensagem'] = 'Erro ao realizar reserva.';
                $_SESSION['tipo_mensagem'] = 'error';
            }

            mysqli_stmt_close($stmt);

        } else {
            $_SESSION['mensagem'] = 'Não foi possível preparar a reserva.';
            $_SESSION['tipo_mensagem'] = 'error';
        }
    }

    header('Location: ../reservas/listar.php');
    exit;
}

header('Location: ../livros/listar.php');
exit;
?>


<?php
require __DIR__ . '/verifica_login.php';
require __DIR__ . '/../conexao.php';

$mensagem = '';
$id = null;
$livros = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if (!$id || $id <= 0) {
        $_SESSION['mensagem'] = 'ID do livro inválido.';
        header('Location: listar.php');
        exit;
    }

    $sql = "DELETE FROM livros WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $id);

        if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) > 0) {
            $_SESSION['mensagem'] = 'Livro excluído com sucesso!';
        } else {
            $_SESSION['mensagem'] = 'O livro não foi encontrado ou não pôde ser excluído.';
        }

        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['mensagem'] = 'Não foi possível preparar a exclusão.';
    }

    header('Location: listar.php');
    exit;
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id <= 0) {
    $mensagem = 'ID do livro inválido ou não informado.';
} else {
    $sql = "SELECT * FROM livros WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);
        $livros = mysqli_fetch_assoc($resultado);

        mysqli_stmt_close($stmt);

        if (!$livros) {
            $mensagem = 'Livro não encontrado.';
        }
    } else {
        $mensagem = 'Não foi possível consultar o livro.';
    }
}

$titulo_pagina = 'Excluir livro';
?>

<?php require __DIR__ . '/../cabecalho.php'; ?>

<main class="content-main">
    <div class="page-heading">
        <div>
            <span class="eyebrow">ACERVO</span>
            <h1>Excluir <em>livro</em></h1>
            <p>Confirme se deseja remover este livro da biblioteca.</p>
        </div>
    </div>

    <?php if ($mensagem !== ''): ?>
        <div class="alert alert-error">
            <?php echo htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8'); ?>
        </div>

        <a href="listar.php" class="button button-light">
            Voltar ao acervo
        </a>

    <?php elseif ($livros): ?>
        <div class="panel">
            <p>
                Tem certeza de que deseja excluir o livro
                <strong>
                    <?php echo htmlspecialchars($livros['titulo'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                </strong>?
            </p>

            <form action="excluir.php" method="POST">
                <input
                    type="hidden"
                    name="id"
                    value="<?php echo (int) $livros['id']; ?>"
                >

                <button type="submit" class="button button-danger">
                    Sim, excluir
                </button>

                <a href="listar.php" class="button button-light">
                    Cancelar
                </a>
            </form>
        </div>
    <?php endif; ?>
</main>

<?php require __DIR__ . '/../rodape.php'; ?>


<?php require __DIR__ . '/../rodape.php'; ?>
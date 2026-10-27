<?php
require __DIR__ . '/verifica_login.php';
require __DIR__ . '/../conexao.php';

$mensagem = '';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    $titulo = trim($_POST['titulo'] ?? '');
    $Autor = trim($_POST['autor'] ?? '');
    $Editora = trim($_POST['editora'] ?? '');
    $ano = trim($_POST['ano_publicacao'] ?? '');
    $categoria = trim($_POST['categoria'] ?? '');
    $quantidade = trim($_POST['quantidade'] ?? '');

    if (!$id || $id <= 0) {
        $mensagem = 'ID do livro inválido.';
    } elseif ($titulo === '' || $Autor === '' || $quantidade === '') {
        $mensagem = 'Preencha o título, o autor e a quantidade.';
    } elseif (!ctype_digit($quantidade)) {
        $mensagem = 'A quantidade deve ser um número inteiro igual ou maior que zero.';
    } else {
        $quantidade = (int) $quantidade;
        $ano = ($ano === '') ? null : $ano;
        $Editora = ($Editora === '') ? null : $Editora;
        $categoria = ($categoria === '') ? null : $categoria;

        $sql = "UPDATE livros SET
                    titulo = ?,
                    Autor = ?,
                    Editora = ?,
                    quantidade = ?,
                    ano_publicacao = ?,
                    categoria = ?
                WHERE id = ?";

        $stmt = mysqli_prepare($conexao, $sql);

        if (!$stmt) {
            error_log('Erro ao preparar edição: ' . mysqli_error($conexao));
            $mensagem = 'Não foi possível preparar a atualização do livro.';
        } else {
            mysqli_stmt_bind_param(
                $stmt,
                'sssissi',
                $titulo,
                $Autor,
                $Editora,
                $quantidade,
                $ano,
                $categoria,
                $id
            );

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['mensagem'] = 'Livro atualizado com sucesso!';
                mysqli_stmt_close($stmt);
                header('Location: listar.php');
                exit;
            } else {
                error_log('Erro ao atualizar livro: ' . mysqli_stmt_error($stmt));
                $mensagem = 'Não foi possível atualizar o livro.';
            }

            mysqli_stmt_close($stmt);
        }
    }
}

if (!$id || $id <= 0) {
    if ($mensagem === '') {
        $mensagem = 'ID do livro inválido ou não informado.';
    }
    $livros = null;
} elseif (!isset($livros)) {
    $sql = "SELECT * FROM livros WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);

    if (!$stmt) {
        error_log('Erro ao preparar consulta: ' . mysqli_error($conexao));
        $mensagem = 'Não foi possível consultar o livro.';
        $livros = null;
    } else {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);
        $livros = mysqli_fetch_assoc($resultado);

        mysqli_stmt_close($stmt);

        if (!$livros) {
            $mensagem = 'Livro não encontrado.';
        }
    }
}

$titulo_pagina = 'Editar livro';
require __DIR__ . '/../cabecalho.php';
?>

<main class="content-main">
    <div class="page-heading">
        <div>
            <span class="eyebrow">ACERVO</span>
            <h1>Editar <em>livro</em></h1>
            <p>Atualize as informações do livro cadastrado.</p>
        </div>
    </div>

    <?php if ($mensagem !== ''): ?>
        <p class="alert alert-error">
            <?php echo htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8'); ?>
        </p>
    <?php endif; ?>

    <?php if ($livros): ?>
        <div class="panel">
            <form action="editar.php" method="POST" class="app-form">
                <input
                    type="hidden"
                    name="id"
                    value="<?php echo (int) $livros['id']; ?>"
                >

                <div class="form-grid">
                    <div>
                        <label for="titulo">Título</label>
                        <input
                            type="text"
                            id="titulo"
                            name="titulo"
                            value="<?php echo htmlspecialchars($livros['titulo'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                            required
                        >
                    </div>

                    <div>
                        <label for="autor">Autor</label>
                        <input
                            type="text"
                            id="autor"
                            name="autor"
                            value="<?php echo htmlspecialchars($livros['Autor'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                            required
                        >
                    </div>

                    <div>
                        <label for="editora">Editora</label>
                        <input
                            type="text"
                            id="editora"
                            name="editora"
                            value="<?php echo htmlspecialchars($livros['Editora'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                        >
                    </div>

                    <div>
                        <label for="ano_publicacao">Ano de publicação</label>
                        <input
                            type="number"
                            id="ano_publicacao"
                            name="ano_publicacao"
                            value="<?php echo htmlspecialchars((string) ($livros['ano_publicacao'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>"
                        >
                    </div>

                    <div>
                        <label for="categoria">Categoria</label>
                        <input
                            type="text"
                            id="categoria"
                            name="categoria"
                            value="<?php echo htmlspecialchars($livros['categoria'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                        >
                    </div>

                    <div>
                        <label for="quantidade">Quantidade</label>
                        <input
                            type="number"
                            id="quantidade"
                            name="quantidade"
                            min="0"
                            value="<?php echo (int) ($livros['quantidade'] ?? 0); ?>"
                            required
                        >
                    </div>
                </div>

                <button type="submit" class="button button-primary button-full">
                    Salvar alterações
                </button>

                <a href="listar.php" class="text-link">
                    Voltar ao acervo
                </a>
            </form>
        </div>
    <?php endif; ?>
</main>

<?php require __DIR__ . '/../rodape.php'; ?>

<?php
require __DIR__ . '/verifica_login.php';
require __DIR__ . '/../conexao.php';

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $autor = trim($_POST['autor'] ?? '');
    $editora = trim($_POST['editora'] ?? '');
    $ano = trim($_POST['ano_publicacao'] ?? '');
    $categoria = trim($_POST['categoria'] ?? '');
    $quantidade = trim($_POST['quantidade'] ?? '');

    // Verifica os campos obrigatórios
    if ($titulo === '' || $autor === '' || $quantidade === '') {
        $mensagem = 'Preencha título, autor e quantidade.';
    } elseif (!ctype_digit($quantidade)) {
        $mensagem = 'A quantidade deve ser um número inteiro igual ou maior que zero.';
    } else {
        // Converte os campos vazios em NULL quando necessário
        $ano = ($ano === '') ? null : $ano;
        $editora = ($editora === '') ? null : $editora;
        $categoria = ($categoria === '') ? null : $categoria;

        // Prepara a consulta SQL
        $sql = "INSERT INTO livros (
                    titulo,
                    autor,
                    editora,
                    ano_publicacao,
                    categoria,
                    quantidade
                ) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conexao, $sql);

        if (!$stmt) {
            die('Erro ao preparar SQL: ' . mysqli_error($conexao));
        } else {
            $quantidade = (int) $quantidade;

            mysqli_stmt_bind_param(
                $stmt,
                'sssssi',
                $titulo,
                $autor,
                $editora,
                $ano,
                $categoria,
                $quantidade
            );

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['mensagem'] = 'Livro cadastrado com sucesso!';

                mysqli_stmt_close($stmt);

                header('Location: listar.php');
                exit;
            } else {
                error_log('Erro ao cadastrar livro: ' . mysqli_stmt_error($stmt));
                $mensagem = 'Não foi possível cadastrar o livro. Verifique os dados e tente novamente.';
            }

            mysqli_stmt_close($stmt);
        }
    }
}

$titulo_pagina = 'Cadastrar livro';

require __DIR__ . '/../cabecalho.php';
?>

<main class="form-page single-form">

    <section class="form-intro">
        <span class="eyebrow">AMPLIE AS POSSIBILIDADES</span>

        <h1>
            Novo livro,<br>
            <em>nova aventura.</em>
        </h1>

        <p>
            Preencha os detalhes para adicionar uma obra ao acervo.
        </p>

        <a class="text-link" href="listar.php">
            ← Voltar ao acervo
        </a>
    </section>

    <section class="panel">
        <h2>Cadastrar livro</h2>

        <p class="muted">
            Os campos com * são obrigatórios.
        </p>

        <?php if ($mensagem !== '') { ?>
            <p class="alert alert-error">
                <?php echo htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8'); ?>
            </p>
        <?php } ?>

        <form method="POST" class="app-form">

            <label for="titulo">Título *</label>

            <input
                id="titulo"
                name="titulo"
                type="text"
                maxlength="150"
                required
                value="<?php echo htmlspecialchars($_POST['titulo'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
            >

            <label for="autor">Autor *</label>

            <input
                id="autor"
                name="autor"
                type="text"
                maxlength="100"
                required
                value="<?php echo htmlspecialchars($_POST['autor'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
            >

            <div class="form-grid">

                <div>
                    <label for="editora">Editora</label>

                    <input
                        id="editora"
                        name="editora"
                        type="text"
                        maxlength="100"
                        value="<?php echo htmlspecialchars($_POST['editora'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                    >
                </div>

                <div>
                    <label for="ano_publicacao">Ano de publicação</label>

                    <input
                        id="ano_publicacao"
                        name="ano_publicacao"
                        type="number"
                        min="0"
                        max="2100"
                        value="<?php echo htmlspecialchars($_POST['ano_publicacao'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                    >
                </div>

            </div>

            <div class="form-grid">

                <div>
                    <label for="categoria">Categoria</label>

                    <input
                        id="categoria"
                        name="categoria"
                        type="text"
                        maxlength="80"
                        value="<?php echo htmlspecialchars($_POST['categoria'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                        placeholder="Ex.: Romance"
                    >
                </div>

                <div>
                    <label for="quantidade">Quantidade *</label>

                    <input
                        id="quantidade"
                        name="quantidade"
                        type="number"
                        min="0"
                        step="1"
                        required
                        value="<?php echo htmlspecialchars($_POST['quantidade'] ?? '1', ENT_QUOTES, 'UTF-8'); ?>"
                    >
                </div>

            </div>

            <button
                class="button button-primary button-full"
                type="submit"
            >
                Salvar livro →
            </button>

        </form>
    </section>

</main>

<?php
require __DIR__ . '/../rodape.php';
?>

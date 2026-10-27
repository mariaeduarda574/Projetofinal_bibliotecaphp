```php
<?php
require __DIR__ . '/verifica_login.php';
require __DIR__ . '/../conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $autor = trim($_POST['autor'] ?? '');
    $editora = trim($_POST['editora'] ?? '');
    $ano = trim($_POST['ano_publicacao'] ?? '');
    $categoria = trim($_POST['categoria'] ?? '');
    $quantidade = trim($_POST['quantidade'] ?? '');

    if ($titulo === '' || $autor === '' || $quantidade === '') {
        $mensagem = 'Preencha título, autor e quantidade.';
    } else {
        $stmt = mysqli_prepare(
            $conexao,
            'INSERT INTO livros (
                titulo,
                autor,
                editora,
                ano_publicacao,
                categoria,
                quantidade
            ) VALUES (?, ?, ?, NULLIF(?, ""), ?, ?)'
        );

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

            header('Location: listar.php');
            exit;
        }

        $mensagem = 'Não foi possível cadastrar o livro.';
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

        <?php if (isset($mensagem)) { ?>
            <p class="alert alert-error">
                <?php echo htmlspecialchars($mensagem); ?>
            </p>
        <?php } ?>

        <form method="POST" class="app-form">

            <label for="titulo">Título *</label>

            <input
                id="titulo"
                name="titulo"
                maxlength="150"
                required
                value="<?php echo htmlspecialchars($_POST['titulo'] ?? ''); ?>"
            >

            <label for="autor">Autor *</label>

            <input
                id="autor"
                name="autor"
                maxlength="100"
                required
                value="<?php echo htmlspecialchars($_POST['autor'] ?? ''); ?>"
            >

            <div class="form-grid">

                <div>
                    <label for="editora">Editora</label>

                    <input
                        id="editora"
                        name="editora"
                        maxlength="100"
                        value="<?php echo htmlspecialchars($_POST['editora'] ?? ''); ?>"
                    >
                </div>

                <div>
                    <label for="ano_publicacao">
                        Ano de publicação
                    </label>

                    <input
                        id="ano_publicacao"
                        name="ano_publicacao"
                        type="number"
                        min="0"
                        max="2100"
                        value="<?php echo htmlspecialchars($_POST['ano_publicacao'] ?? ''); ?>"
                    >
                </div>

            </div>

            <div class="form-grid">

                <div>
                    <label for="categoria">Categoria</label>

                    <input
                        id="categoria"
                        name="categoria"
                        maxlength="80"
                        value="<?php echo htmlspecialchars($_POST['categoria'] ?? ''); ?>"
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
                        required
                        value="<?php echo htmlspecialchars($_POST['quantidade'] ?? '1'); ?>"
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
```
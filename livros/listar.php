
<?php
require __DIR__ . '/verifica_login.php';
require __DIR__ . '/../conexao.php';

$titulo_pagina = 'Acervo';

require __DIR__ . '/../cabecalho.php';

$sql = "SELECT * FROM livros ORDER BY titulo";
$resultado = mysqli_query($conexao, $sql);
?>

<main class="content-main">
    <div class="page-heading">
        <div>
            <span class="eyebrow">CATÁLOGO</span>

            <h1>
                Nosso <em>acervo</em>
            </h1>

            <p>
                Todos os livros cadastrados na biblioteca.
            </p>
        </div>

        <a class="button button-primary" href="cadastrar.php">
            ＋ Novo livro
        </a>
    </div>

    <?php if (isset($_SESSION['mensagem'])) { ?>
        <p class="alert alert-success">
            <?php
            echo htmlspecialchars($_SESSION['mensagem']);
            unset($_SESSION['mensagem']);
            ?>
        </p>
    <?php } ?>

    <div class="table-wrap">

        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Editora</th>
                    <th>Ano</th>
                    <th>Categoria</th>
                    <th>Quantidade</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>

                <?php
                if ($resultado && mysqli_num_rows($resultado) > 0) {
                    while ($livro = mysqli_fetch_assoc($resultado)) {
                ?>

                    <tr>
                        <td class="book-title">
                            <?php echo htmlspecialchars($livro['titulo']); ?>
                        </td>

                        <td>
                           <?php echo htmlspecialchars($livro['Autor'] ?? ''); ?>
                        </td>

                        <td>
                           <?php echo htmlspecialchars($livro['Editora'] ?? ''); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars((string) $livro['ano_publicacao']); ?>
                        </td>

                        <td>
                            <span class="category-pill">
                                <?php echo htmlspecialchars($livro['categoria']); ?>
                            </span>
                        </td>

                        <td>
                            <?php echo (int) $livro['quantidade']; ?>
                        </td>

                        <td class="actions">
                            <a
                                class="action-link"
                                href="editar.php?id=<?php echo (int) $livro['id']; ?>"
                            >
                                Editar
                            </a>

                            <a
                                class="action-link action-delete"
                                href="excluir.php?id=<?php echo (int) $livro['id']; ?>"
                            >
                                Excluir
                            </a>
                        </td>
                    </tr>

                <?php
                    }
                } else {
                ?>

                    <tr>
                        <td colspan="7" class="empty-state">
                            Ainda não há livros cadastrados.
                            Adicione o primeiro título ao acervo!
                        </td>
                    </tr>

                <?php } ?>

            </tbody>
        </table>

    </div>

</main>

<?php
require __DIR__ . '/../rodape.php';
?>


<?php
require __DIR__ . '/verifica_login.php';
require __DIR__ . '/../conexao.php';

$titulo_pagina = 'Acervo';

$sql = "SELECT * FROM livros ORDER BY titulo";
$resultado = mysqli_query($conexao, $sql);

require __DIR__ . '/../cabecalho.php';

$isAdmin = isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin';
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

        <?php if ($isAdmin) { ?>
            <a class="button button-primary" href="cadastrar.php">
                ＋ Novo livro
            </a>
        <?php } ?>
    </div>

    <?php if (isset($_SESSION['mensagem'])) { ?>

        <?php $tipo_mensagem = $_SESSION['tipo_mensagem'] ?? 'success'; ?>

        <p class="alert alert-<?php echo htmlspecialchars($tipo_mensagem); ?>">
            <?php echo htmlspecialchars($_SESSION['mensagem']); ?>
        </p>

        <?php
        unset($_SESSION['mensagem']);
        unset($_SESSION['tipo_mensagem']);
        ?>

    <?php } ?>

    <div class="table-wrap">

        <table>
            <thead>
                <tr>
                    <th>Capa</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Editora</th>
                    <th>Ano</th>
                    <th>Categoria</th>
                    <th>Disponíveis</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>

                <?php if ($resultado && mysqli_num_rows($resultado) > 0) { ?>

                    <?php while ($livro = mysqli_fetch_assoc($resultado)) { ?>

                        <tr>

                            <td>
                                <?php
                                $imagem = $livro['imagem'] ?? '';
                                $caminhoImagem = __DIR__ . '/../img/livros/' . basename($imagem);
                                ?>

                                <?php if ($imagem !== '' && is_file($caminhoImagem)) { ?>
                                    <img
                                        src="../img/livros/<?php echo rawurlencode(basename($imagem)); ?>"
                                        alt="Capa de <?php echo htmlspecialchars($livro['titulo']); ?>"
                                        style="width:65px;height:90px;object-fit:cover;border-radius:6px;"
                                    >
                                <?php } else { ?>
                                    <span class="muted">Sem capa</span>
                                <?php } ?>
                            </td>

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
                                <?php echo htmlspecialchars((string) ($livro['ano_publicacao'] ?? '')); ?>
                            </td>

                            <td>
                                <span class="category-pill">
                                    <?php echo htmlspecialchars($livro['categoria'] ?? ''); ?>
                                </span>
                            </td>

                            <td>
                                <?php
                                $disponiveis = (int) $livro['quantidade'];
                                echo $disponiveis;
                                ?>

                                <?php if ($disponiveis <= 0) { ?>
                                    <span class="muted">Indisponível</span>
                                <?php } ?>
                            </td>

                            <td class="actions">

                                <?php if ($isAdmin) { ?>

                                    <a href="editar.php?id=<?php echo (int) $livro['id']; ?>"
                                       class="action-link">
                                        Editar
                                    </a>

                                    <a href="excluir.php?id=<?php echo (int) $livro['id']; ?>"
                                       class="action-link action-delete">
                                        Excluir
                                    </a>

                                <?php } ?>

                                <?php if ($disponiveis > 0) { ?>

                                    <form action="../reservas/criar.php"
                                          method="POST"
                                          class="form-reservar">

                                        <input
                                            type="hidden"
                                            name="livro_id"
                                            value="<?php echo (int) $livro['id']; ?>"
                                        >

                                        <button type="submit" class="btn-reservar">
                                            Emprestar
                                        </button>

                                    </form>

                                <?php } else { ?>

                                    <span class="muted">Sem exemplares</span>

                                <?php } ?>

                            </td>

                        </tr>

                    <?php } ?>

                <?php } else { ?>

                    <tr>
                        <td colspan="8" class="empty-state">
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

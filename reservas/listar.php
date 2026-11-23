
<?php
require __DIR__ . '/../livros/verifica_login.php';
require __DIR__ . '/../conexao.php';

$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT
            reservas.id,
            usuarios.nome,
            livros.titulo,
            reservas.data_reserva,
            reservas.status
        FROM reservas
        INNER JOIN usuarios
            ON reservas.usuario_id = usuarios.id
        INNER JOIN livros
            ON reservas.livro_id = livros.id
        WHERE reservas.usuario_id = ?
        ORDER BY reservas.data_reserva DESC";

$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, 'i', $usuario_id);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

$titulo_pagina = 'Minhas reservas';

require __DIR__ . '/../cabecalho.php';
?>

<main class="content-main">

    <div class="page-heading">
        <div>
            <span class="eyebrow">BIBLIOTECA AURORA</span>
            <h1>Minhas <em>reservas</em></h1>
            <p>Acompanhe os livros que você reservou.</p>
        </div>
    </div>

    <div class="table-wrap">

        <?php if (mysqli_num_rows($resultado) > 0): ?>

            <table>
                <thead>
                    <tr>
                        <th>Livro</th>
                        <th>Data da reserva</th>
                        <th>Status</th>
                        <th>Remover</th>
                    </tr>
                </thead>

                <tbody>

                    <?php while ($reserva = mysqli_fetch_assoc($resultado)): ?>

                        <tr>
                            <td class="book-title">
                                <?php echo htmlspecialchars($reserva['titulo']); ?>
                            </td>

                            <td>
                                <?php
                                echo date(
                                    'd/m/Y H:i',
                                    strtotime($reserva['data_reserva'])
                                );
                                ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($reserva['status']); ?>
                            </td>

                            <td>
                                <form
                                    action="excluir.php"
                                    method="POST"
                                    onsubmit="return confirm('Deseja realmente remover esta reserva?');"
                                >

                                    <input
                                        type="hidden"
                                        name="reserva_id"
                                        value="<?php echo (int) $reserva['id']; ?>"
                                    >

                                    <button
                                        type="submit"
                                        class="btn-lixeira"
                                        title="Remover reserva"
                                        aria-label="Remover reserva"
                                    >
                                        🗑
                                    </button>

                                </form>
                            </td>
                        </tr>

                    <?php endwhile; ?>

                </tbody>
            </table>

        <?php else: ?>

            <div class="empty-state">
                <h3>Você ainda não possui reservas!</h3>
                <p>Que tal encontrar um livro para ler?</p>

                <a href="../livros/listar.php" class="button button-primary">
                    Ver livros disponíveis
                </a>
            </div>

        <?php endif; ?>

    </div>

</main>

<?php require __DIR__ . '/../rodape.php'; ?>

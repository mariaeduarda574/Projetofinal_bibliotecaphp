```php
<?php
session_start();

require __DIR__ . '/conexao.php';

$base_url = '/Projetofinal_bibliotecaphp/';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    $stmt = mysqli_prepare(
        $conexao,
        'SELECT id, nome FROM usuarios WHERE email = ? AND senha = ?'
    );

    mysqli_stmt_bind_param($stmt, 'ss', $email, $senha);
    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);

    if ($usuario = mysqli_fetch_assoc($resultado)) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];

        header('Location: ' . $base_url . 'livros/listar.php');
        exit;
    } else {
        $mensagem = 'E-mail ou senha inválidos.';
    }
}

$titulo_pagina = 'Entrar';

require __DIR__ . '/cabecalho.php';
?>

<main class="form-page">
    <section class="form-intro">
        <span class="eyebrow">BEM-VINDO DE VOLTA</span>

        <h1>
            Entre no seu<br>
            <em>cantinho literário.</em>
        </h1>

        <p>
            Acesse o painel para cuidar do acervo da Biblioteca Aurora.
        </p>
    </section>

    <section class="panel login-panel">
        <div class="panel-icon">✦</div>

        <h2>Fazer login</h2>

        <p class="muted">Informe seus dados de acesso.</p>

        <?php if (isset($mensagem)) { ?>
            <p class="alert alert-error">
                <?php echo htmlspecialchars($mensagem); ?>
            </p>
        <?php } ?>

        <form
            action="<?php echo $base_url; ?>login.php"
            method="POST"
            class="app-form"
        >
            <label for="email">E-mail</label>

            <input
                id="email"
                type="email"
                name="email"
                autocomplete="username"
                required
            >

            <label for="senha">Senha</label>

            <input
                id="senha"
                type="password"
                name="senha"
                autocomplete="current-password"
                required
            >

            <button
                class="button button-primary button-full"
                type="submit"
            >
                Entrar na biblioteca →
            </button>
        </form>
    </section>
</main>

<?php
require __DIR__ . '/rodape.php';
?>
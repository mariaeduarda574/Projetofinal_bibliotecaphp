
<?php

require_once __DIR__ . '/livros/verifica_login.php';

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') {
    http_response_code(403);

    $titulo_pagina = 'Acesso negado';

    require __DIR__ . '/cabecalho.php';
    ?>

    <main class="form-page">
        <section class="panel login-panel">

            <div class="panel-icon">✕</div>

            <h2>Ação não permitida!</h2>

            <p class="muted">
                Você não tem permissão para acessar esta funcionalidade.
                Somente administradores podem realizar essa ação.
            </p>

            <a href="/Projetofinal_bibliotecaphp/livros/listar.php"
               class="button button-primary button-full">
                Voltar ao acervo
            </a>

        </section>
    </main>

    <?php
    require __DIR__ . '/rodape.php';
    exit;
}

<?php
$titulo_pagina = 'Início';
require __DIR__ . '/cabecalho.php';
?>
<main class="home-main">
    <section class="hero">

        <div class="hero-copy"><span class="eyebrow">SEU PRÓXIMO CAPÍTULO COMEÇA AQUI</span>

        <h1>Histórias que<br><em>iluminam mundos.</em></h1>

        <p>Organize seu acervo, descubra livros e mantenha cada história ao alcance das mãos.</p>

            <div class="hero-actions">
                <a class="button button-primary" href="<?php echo $base_url; ?>livros/listar.php">Explorar acervo <span>→</span></a>
                <a class="button button-light" href="<?php echo $base_url; ?>livros/cadastrar.php">+ Cadastrar livro</a>
            </div>
        </div>
        <div class="hero-art" aria-label="Ilustração decorativa de livros">
            <div class="moon"></div>
            <div class="book-stack">
                <div class="book book-one">LEITURAS<br>INFINITAS</div>
                <div class="book book-two">POESIA &amp; ALMA</div>
                <div class="book book-three">NOVOS MUNDOS</div>
            </div><span class="spark spark-a">✦</span><span class="spark spark-b">✧</span>
        </div>
    </section>

    <section class="welcome-row">
        <div><span class="eyebrow">BIBLIOTECA DIGITAL</span>
            <h2>Um espaço para cada história</h2>
            <p>Gerencie títulos, autores, editoras e exemplares em um só lugar.</p>
        </div>
        <div class="date-card"><span>HOJE É</span>
            <strong><?php echo date('d/m/Y'); ?></strong>
            <small>Um ótimo dia para ler.</small>
        </div>
    </section>
</main>
<?php require __DIR__ . '/rodape.php'; ?>

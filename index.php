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


<section class="porque-ler">
    <div class="porque-intro">
        <span class="porque-etiqueta">DESCUBRA O PRAZER DA LEITURA</span>
        <h2>Por que <em>ler?</em></h2>
        <p>
            Muito além das páginas, a leitura abre portas para
            novos conhecimentos, ideias e possibilidades.
            Cada livro tem algo novo para ensinar.
        </p>
    </div>

    <div class="porque-cards">

        <div class="porque-card">
            <div class="porque-icone">🧠</div>
            <h3>Conhecimento</h3>
            <p>
                Cada livro é uma oportunidade de aprender algo novo
                e descobrir diferentes assuntos.
            </p>
        </div>

        <div class="porque-card">
            <div class="porque-icone">✨</div>
            <h3>Imaginação</h3>
            <p>
                As histórias nos levam a novos mundos e despertam
                nossa criatividade.
            </p>
        </div>

        <div class="porque-card">
            <div class="porque-icone">💬</div>
            <h3>Comunicação</h3>
            <p>
                A leitura amplia nosso vocabulário e nos ajuda
                a expressar melhor nossas ideias.
            </p>
        </div>

        <div class="porque-card">
            <div class="porque-icone">🌷</div>
            <h3>Novas perspectivas</h3>
            <p>
                Conhecemos diferentes experiências, culturas
                e maneiras de enxergar o mundo.
            </p>
        </div>

    </div>

    <div class="porque-frase">
        <p>
            "Um livro pode ser o começo de uma descoberta
            que transforma a maneira como vemos o mundo."
        </p>
        <span>Biblioteca Aurora</span>
    </div>
</section>























</main>
<?php require __DIR__ . '/rodape.php'; ?>

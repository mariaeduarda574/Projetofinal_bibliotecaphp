<?php
$base_url = '/Projetofinal_bibliotecaphp/';
$titulo_pagina = $titulo_pagina ?? 'Biblioteca Aurora';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#4c2678">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/estilo.css">
    <title><?php echo htmlspecialchars($titulo_pagina); ?> | Biblioteca Aurora</title>
</head>
<body>
<header class="site-header">
  <a class="brand" href="<?php echo $base_url; ?>index.php"><span class="brand-icon">✦</span><span><strong>Biblioteca Aurora</strong><small>Um universo de histórias</small></span></a>
  <nav class="main-nav">
    <a href="<?php echo $base_url; ?>index.php">Início</a>
    <a href="<?php echo $base_url; ?>livros/listar.php">Acervo</a>
    <a href="<?php echo $base_url; ?>livros/cadastrar.php">Cadastrar livro</a>
    <a href="<?php echo $base_url; ?>login.php">Entrar</a>
    <a class="nav-exit" href="<?php echo $base_url; ?>logout.php">Sair</a>
  </nav>
</header>

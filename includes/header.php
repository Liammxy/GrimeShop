<?php
// Captura o nome do arquivo atual (ex: index.php, suporte.php, colecoes.php)
$pagina_atual = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grime Shop | Streetwear Independente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Estética Cursed / Streetwear */
        body {
            background-color: #000000;
            color: #ffffff;
            font-family: 'Courier New', Courier, monospace;
            letter-spacing: -0.5px;
        }

        /* Ajustes da Barra de Navegação */
        .navbar-cursed {
            background-color: #000000;
            border-bottom: 1px solid #111111;
            padding: 30px 0; /* Aumenta a área do topo para dar mais respiro à logo */
        }
        
        /* Estilização da Logo em Texto (Brutalismo) */
        .logo-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            line-height: 1;
        }

        .logo-main {
            font-size: 2rem;
            font-weight: 900;
            letter-spacing: 4px;
            color: #ffffff !important;
            text-decoration: none;
            text-transform: uppercase;
        }

        .logo-sub {
            font-size: 0.65rem;
            letter-spacing: 6px;
            color: #ff0033;
            text-transform: uppercase;
            margin-top: 5px;
            font-weight: bold;
        }

        /* Ajustes dos Links do Menu */
        .nav-link-cursed {
            text-transform: uppercase;
            font-size: 0.85rem;
            font-weight: bold;
            color: #666666 !important;
            letter-spacing: 1px;
            padding: 10px 20px !important; /* Mais espaçamento entre os botões do menu */
            transition: all 0.3s ease;
            position: relative;
            text-decoration: none !important; /* REMOVE A LINHA PADRÃO QUE ATRAVESSA O TEXTO */
        }

        /* Efeito discreto de linha ao passar o mouse */
        .nav-link-cursed:hover, .nav-link-cursed.active {
            color: #ffffff !important;
        }
        
        .nav-link-cursed::after {
            content: '';
            position: absolute;
            width: 0;
            height: 1px;
            bottom: 5px;
            left: 20px;
            background-color: #ff0033;
            transition: width 0.3s ease;
        }
        
        .nav-link-cursed:hover::after, .nav-link-cursed.active::after {
            width: calc(100% - 40px);
        }

        /* Customização do botão sanduíche no mobile */
        .navbar-toggler {
            border: 1px solid #222 !important;
            border-radius: 0px !important;
            padding: 8px !important;
        }
        
        .navbar-toggler:focus {
            box-shadow: none !important;
        }
        
        .navbar-toggler-icon {
            filter: invert(1); /* Deixa o ícone do menu branco */
        }

        /* ... Seus estilos de botões e cards continuam aqui embaixo ... */
        .btn-cursed {
            background-color: #ffffff;
            color: #000000;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.8rem;
            border-radius: 0px !important;
            letter-spacing: 1px;
            border: 1px solid #ffffff;
            padding: 12px 24px;
            transition: all 0.3s ease;
        }
        .btn-cursed:hover {
            background-color: #000000;
            color: #ffffff;
            border-color: #ffffff;
        }
        /* Cards de Produto Streetwear - Borda Vermelha Fixa */
        .card-cursed {
            background-color: #0c0c0c;
            border: 1px solid #ff0033; /* Borda vermelha ativa o tempo todo */
            border-radius: 0px !important;
            transition: transform 0.3s ease; /* Transição suave caso queira algum movimento futuro */
        }

        /* Foto 100% natural, sem filtros e sem zoom */
        .card-cursed img {
            border-radius: 0px !important;
            height: 400px;
            object-fit: cover;
        }

        /* Textos e Espaçamentos */
        .product-title {
            font-size: 1.1rem;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 15px;
            letter-spacing: 0.5px;
            color: #ffffff;
        }

        /* Garante contraste alto nas descrições dos cards no fundo grafite */
        .product-desc {
            font-weight: 300 !important;
            opacity: 0.9 !important;
            color: #f8f9fa !important; 
        }

        .product-price {
            font-size: 1.3rem;
            color: #ff0033;
            font-weight: 900;
            margin-bottom: 15px;
            letter-spacing: 1px;
        }
    </style>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-cursed mb-5" style="border-bottom: 1px solid #ff0033">
        <div class="container">
            
            <a class="logo-container text-decoration-none" href="/index.php">
    <img src="/images/logo-grime.jpeg" alt="Grime Shop Logo" style="max-height: 90px; width: auto; object-fit: contain;">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mt-3 mt-lg-0">
    <li class="nav-item">
        <a class="nav-link-cursed <?php echo ($pagina_atual == 'index.php') ? 'active' : ''; ?>" href="/index.php">Drop Inicial</a>
    </li>
    <li class="nav-item">
        <a class="nav-link-cursed <?php echo ($pagina_atual == 'colecoes.php') ? 'active' : ''; ?>" href="/paginas/colecoes.php">Coleções</a>
    </li>
    <li class="nav-item">
        <a class="nav-link-cursed <?php echo ($pagina_atual == 'acessorios.php') ? 'active' : ''; ?>" href="/paginas/acessorios.php">Acessórios</a>
    </li>
    <li class="nav-item">
        <a class="nav-link-cursed <?php echo ($pagina_atual == 'suporte.php') ? 'active' : ''; ?>" href="/paginas/suporte.php">Suporte</a>
    </li>
    <li class="nav-item">
        <a class="nav-link-cursed <?php echo ($pagina_atual == 'carrinho.php') ? 'active' : ''; ?>" href="/paginas/carrinho.php">Carrinho (2)</a>
    </li>
</ul>
            </div>
            
        </div>
    </nav>
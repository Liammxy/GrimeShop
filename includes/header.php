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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cardo:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    
    <style>
        /* Estética Cursed / Streetwear */
        body {
            background-color: #000000;
            color: #ffffff;
            font-family: 'Courier New', Courier, monospace;
            letter-spacing: -0.5px;
        }

        /* Aplica nos títulos, links do menu e cabeçalhos */
         h1, h2, h3, h4, h5, h6, .nav-link, .navbar-brand {
             font-family: 'Cardo', serif !important;
         }

        /* Ajustes da Barra de Navegação */
        .navbar-cursed {
            background-color: #000000;
            border-bottom: 1px solid #111111;
            padding: 20px 0; /* Ajustado levemente para não esmagar o mobile */
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

        /* Customização BRUTALISTA do botão sanduíche no mobile (Grime Style) */
        .navbar-toggler-grime {
            border: 1px solid #ff0033 !important; /* Borda vermelha marcante */
            border-radius: 0px !important;       /* Cantos totalmente retos e secos */
            padding: 8px 10px !important;
            background-color: rgba(12, 12, 12, 0.85) !important; /* Fundo escuro opaco contra o vídeo */
            transition: all 0.2s ease-in-out;
        }
        
        .navbar-toggler-grime:focus {
            box-shadow: 0 0 10px rgba(255, 0, 51, 0.5) !important; /* Brilho de foco vermelho */
        }
        
        .navbar-toggler-icon-grime {
            /* Filtro mágico para forçar os 3 risquinhos a ficarem no tom vermelho/neon visível no escuro */
            filter: invert(1) sepia(1) saturate(5) hue-rotate(340deg) !important; 
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

        /* efeito na logo ao passar o mouse */
        .logo-animada:hover{
            transform: scale(1.0); /* leve zoom */
            filter: drop-shadow(0 0 15px #ff0033) !important; /* faz o vermelho estourar */
            transition: all 0.3s ease-in-out; /* transição mais fluida */
        }

        .card {
            transition: all 0.3s ease-in-out;
        }
        .card:hover {
            transform: scale(1.01); /* um pequeno zoom */ 
            filter: drop-shadow(0 0 18px #ff0033);
            background-color: #121212 !important;
        }

        /* Ajuste de margem dos links para o menu colapsado no mobile */
        @media (max-width: 991.98px) {
            .navbar-nav {
                background-color: rgba(10, 10, 10, 0.95);
                padding: 15px;
                border: 1px solid #ff0033;
                margin-top: 10px !important;
            }
            .nav-link-cursed::after {
                left: 0px !important;
            }
            .nav-link-cursed:hover::after, .nav-link-cursed.active::after {
                width: 100% !important;
            }
        }

    </style>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-cursed p-0" style="border-bottom: 1px solid #ff0033">
        <div class="container">
            
            <a class="logo-container text-decoration-none" href="/ProjetoGrimeShop/index.php" data-aos="zoom-in" data-aos-duration="1200">
                <img src="/ProjetoGrimeShop/images/logo-grime.jpeg" alt="Grime Shop Logo" class="logo-animada" style="max-height: 100px; width: auto; object-fit: contain; transition: all 0.4s ease-in-out;">
            </a>
            
            <div class="collapse navbar-collapse d-none d-lg-block" id="navbarNav">
                <ul class="navbar-nav ms-auto mt-3 mt-lg-0" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="200">
                    <li class="nav-item">
                        <a class="nav-link-cursed <?php echo ($pagina_atual == 'index.php') ? 'active' : ''; ?>" href="/ProjetoGrimeShop/index.php">Drop Inicial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-cursed <?php echo ($pagina_atual == 'colecoes.php') ? 'active' : ''; ?>" href="/ProjetoGrimeShop/paginas/colecoes.php">Coleções</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-cursed <?php echo ($pagina_atual == 'acessorios.php') ? 'active' : ''; ?>" href="/ProjetoGrimeShop/paginas/acessorios.php">Acessórios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-cursed <?php echo ($pagina_atual == 'suporte.php') ? 'active' : ''; ?>" href="/ProjetoGrimeShop/paginas/suporte.php">Suporte</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-cursed <?php echo ($pagina_atual == 'carrinho.php') ? 'active' : ''; ?>" href="/ProjetoGrimeShop/paginas/carrinho.php">Carrinho (2)</a>
                    </li>
                </ul>
            </div>

            <div class="dropdown d-lg-none">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: 1px solid #ff0033; border-radius: 0px; background-color: rgba(12, 12, 12, 0.85); padding: 8px 10px;">
                    <div style="width: 20px; height: 14px; display: flex; flex-direction: column; justify-content: space-between;">
                        <span style="display: block; width: 100%; height: 2px; background-color: #ff0033;"></span>
                        <span style="display: block; width: 100%; height: 2px; background-color: #ff0033;"></span>
                        <span style="display: block; width: 100%; height: 2px; background-color: #ff0033;"></span>
                    </div>
                </button>
                
                <ul class="dropdown-menu dropdown-menu-end" style="background-color: #0c0c0c; border: 1px solid #ff0033; border-radius: 0px; padding: 10px 0; min-width: 200px;">
                    <li><a class="dropdown-item <?php echo ($pagina_atual == 'index.php') ? 'text-white fw-bold' : ''; ?>" href="/ProjetoGrimeShop/index.php" style="color: #666666; font-family: 'Cardo', serif; text-transform: uppercase; font-size: 0.9rem; padding: 10px 20px;">Drop Inicial</a></li>
                    <li><a class="dropdown-item <?php echo ($pagina_atual == 'colecoes.php') ? 'text-white fw-bold' : ''; ?>" href="/ProjetoGrimeShop/paginas/colecoes.php" style="color: #666666; font-family: 'Cardo', serif; text-transform: uppercase; font-size: 0.9rem; padding: 10px 20px;">Coleções</a></li>
                    <li><a class="dropdown-item <?php echo ($pagina_atual == 'acessorios.php') ? 'text-white fw-bold' : ''; ?>" href="/ProjetoGrimeShop/paginas/acessorios.php" style="color: #666666; font-family: 'Cardo', serif; text-transform: uppercase; font-size: 0.9rem; padding: 10px 20px;">Acessórios</a></li>
                    <li><a class="dropdown-item <?php echo ($pagina_atual == 'suporte.php') ? 'text-white fw-bold' : ''; ?>" href="/ProjetoGrimeShop/paginas/suporte.php" style="color: #666666; font-family: 'Cardo', serif; text-transform: uppercase; font-size: 0.9rem; padding: 10px 20px;">Suporte</a></li>
                    <li><hr class="dropdown-divider" style="border-color: #ff0033; opacity: 0.3;"></li>
                    <li><a class="dropdown-item <?php echo ($pagina_atual == 'carrinho.php') ? 'text-white fw-bold' : ''; ?>" href="/ProjetoGrimeShop/paginas/carrinho.php" style="color: #ff0033; font-family: 'Cardo', serif; text-transform: uppercase; font-size: 0.9rem; padding: 10px 20px;">Carrinho (2)</a></li>
                </ul>
            </div>
            
        </div>
    </nav>
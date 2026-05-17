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
        .card-cursed {
            background-color: #000000;
            border: 1px solid #111111;
            border-radius: 0px !important;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .card-cursed:hover { border-color: #ffffff; }
        .card-cursed img {
            border-radius: 0px !important;
            filter: grayscale(100%) contrast(120%);
            transition: filter 0.4s ease;
            height: 380px;
            object-fit: cover;
        }
        .card-cursed:hover img { filter: grayscale(0%) contrast(100%); }
        .product-title { font-size: 1.1rem; font-weight: bold; text-transform: uppercase; margin-top: 15px; letter-spacing: 0.5px; }
        .product-price { font-size: 1.2rem; color: #ffffff; font-weight: bold; margin-bottom: 15px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-cursed mb-5">
        <div class="container">
            
            <a class="logo-container text-decoration-none" href="index.php">
                <span class="logo-main">GRIME SHOP</span>
                <span class="logo-sub">CLOTHING CO.</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mt-3 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link-cursed active" href="index.php">Drop Inicial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-cursed" href="#">Coleções</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-cursed" href="#">Acessórios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-cursed" href="#">Suporte</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-cursed text-white" href="#" style="font-weight: 900;">
                            Carrinho (0)
                        </a>
                    </li>
                </ul>
            </div>
            
        </div>
    </nav>
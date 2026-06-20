<?php 
// Puxa o cabeçalho estilizado
include 'includes/header.php'; 

// 1. Inclui o arquivo de conexão apontando para a pasta certa
include('config/conexao.php');

// 2. Faz a query para buscar todos os produtos cadastrados no banco
$sql_produtos = "SELECT * FROM Produto";
$resultado = $conexao->query($sql_produtos);
?>

<main class="position-relative overflow-hidden pb-0 pt-0">

    <video autoplay muted loop playsinline class="position-absolute top-50 start-50 translate-middle w-100 h-100" style="object-fit: cover; z-index: 1; pointer-events: none;">
        <source src="images/fundo.mp4" type="video/mp4">
    </video>

    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(18, 18, 18, 0.75); z-index: 2;"></div>

    <div class="container position-relative" style="z-index: 3;">

        <div class="container my-4">

            <div class="p-5 mb-5 text-center d-flex align-items-center" style="background-color: #0c0c0c; border: 1px solid #ff0033; min-height: 300px;" data-aos="fade-down" data-aos-duration="1200">
                <div class="py-2 w-100">
                    <h1 class="display-4 fw-bold mb-3 text-white" style="letter-spacing: 2px;">REVOLUCIONE SEU ESTILO</h1>
                    <p class="fs-5 text-light mb-4 mx-auto" style="font-weight: 300; opacity: 0.85; max-width: 700px;">
                        Aguarde o próximo drop. Coturnos pesados, calças baggy e estética urbana underground.
                    </p>
                    <a href="paginas/colecoes.php" class="btn btn-cursed">Ver Coleções</a>
                    <style>
                     .btn-cursed {
                         transition: all 0.3s ease-in-out;
                     }
                    .btn-cursed:hover {
                    background-color: #ff0033 !important;
                    color: #fff !important;
                    box-shadow: 0 0 15px #ff0033, 0 0 25px #ff0033;
                    border-color: #ff0033 !important;
                     }
                    </style>
                </div>
            </div>

            <h2 class="mb-4 text-uppercase" style="font-size: 1.3rem; letter-spacing: 1px; color: #888; padding-left: 0;">Lançamentos</h2>

            <div class="row g-4">
                
                <?php
                // O laço while vai repetir esse bloco de col-md-4 para cada produto que estiver cadastrado no banco de dados
                while($produto = $resultado->fetch_assoc()) {
                ?>
                    <div class="col-md-4" data-aos="fade-up">
                        <div class="card card-cursed p-3 h-100">
                            <img src="images/<?php echo basename($produto['im_produto']); ?>" class="card-img-top" alt="<?php echo $produto['nm_produto']; ?>">
                            
                            <div class="card-body p-0 text-center">
                                <h5 class="product-title"><?php echo $produto['nm_produto']; ?></h5>
                                <p class="small product-desc mb-2"><?php echo $produto['ds_produto']; ?></p>
                                <p class="product-price">R$ <?php echo number_format($produto['vl_produto'], 2, ',', '.'); ?></p>
                                <button class="btn btn-cursed btn-add-carrinho text-uppercase w-100 fw-bold" data-id="<?php echo $produto['id_produto']; ?>">
                                Adicionar ao Carrinho
                                </button>
                            </div>
                        </div>
                    </div>
                <?php
                } // Fim do laço de repetição do PHP
                ?>

            </div>
        </div>
    </div>
</main>

<?php 
// Puxa o rodapé
include 'includes/footer.php'; 
?>
<?php 
// 1. Puxa o cabeçalho mudando o caminho para sair da pasta 'paginas'
include '../includes/header.php'; 

// 2. Inclui a conexão saindo da pasta 'paginas' e entrando em 'config'
include '../config/conexao.php';

// 3. Busca APENAS os produtos da categoria 3 (Camisas)
$sql_camisas = "SELECT * FROM Produto WHERE id_categoria = 3";
$resultado = $conexao->query($sql_camisas);
?>

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

<main class="position-relative overflow-hidden pb-0 pt-0">

    <video autoplay muted loop playsinline class="position-absolute top-50 start-50 translate-middle w-100 h-100" style="object-fit: cover; z-index: 1; pointer-events: none;">
        <source src="../images/fundo.mp4" type="video/mp4">
    </video>

    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(18, 18, 18, 0.75); z-index: 2;"></div>

    <div class="container position-relative" style="z-index: 3;">

        <div class="container my-4">

            <h1 class="text-light text-center mb-5 text-uppercase" style="letter-spacing: 2px; font-weight: bold;" data-aos="fade-down">CAMISAS</h1>

            <div class="row g-4">
                
                <?php
                // Se encontrar camisas no banco, roda o laço idêntico ao do index
                if ($resultado && $resultado->num_rows > 0) {
                    while($produto = $resultado->fetch_assoc()) {
                ?>
                    <div class="col-md-4" data-aos="fade-up">
                        <div class="card card-cursed p-3 h-100">
                            <img src="../images/<?php echo basename($produto['im_produto']); ?>" class="card-img-top" alt="<?php echo $produto['nm_produto']; ?>">
                            
                            <div class="card-body p-0 text-center">
                                <h5 class="product-title mt-3"><?php echo $produto['nm_produto']; ?></h5>
                                <p class="small product-desc mb-2"><?php echo $produto['ds_produto']; ?></p>
                                <p class="product-price">R$ <?php echo number_format($produto['vl_produto'], 2, ',', '.'); ?></p>
                                <button class="btn btn-cursed btn-add-carrinho text-uppercase w-100 fw-bold" data-id="<?php echo $produto['id_produto']; ?>">
                                Adicionar ao Carrinho
                                </button>
                            </div>
                        </div>
                    </div>
                <?php
                    } // Fim do laço
                } else {
                    echo "<p class='text-light text-center w-100' style='z-index: 5;'>Nenhuma camisa encontrada no momento.</p>";
                }
                ?>

            </div>
        </div>
    </div>
</main>

<?php 
// Puxa o rodapé mudando o caminho para sair da pasta 'paginas'
include '../includes/footer.php'; 
?>
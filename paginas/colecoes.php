<?php 
// Informa ao header que esta página está dentro de uma pasta (ajuda a corrigir caminhos se necessário)
$path = '../'; 
// Volta um nível de pasta para achar o diretório includes
include '../includes/header.php'; 
?>

<main class="position-relative overflow-hidden pt-0 pb-0">

    <!-- VÍDEO EM SEGUNDO PLANO -->
    <video autoplay muted loop playsinline class="position-absolute top-50 start-50 translate-middle w-100 h-100" style="object-fit: cover; z-index: 1; pointer-events: none;">
        <source src="../images/fundo.mp4" type="video/mp4">
    </video>

    <!-- CAMADA ESCURA -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(18, 18, 18, 0.75); z-index: 2;"></div>

    <!-- SEU CONTAINER DE CONTEÚDO EXISTENTE -->
    <div class="container position-relative" style="z-index: 3; py-5;">

<div class="container my-4">
    <div class="mb-5 mt-4" data-aos="fade-down" data-aos-duration="1000">
        <h1 class="display-5 fw-bold text-white text-uppercase mb-2" style="letter-spacing: 2px;">[ COLEÇÕES ]</h1>
        <p class="text-light" style="font-weight: 300; opacity: 0.85;">Explore nossos drops divididos por categorias urbanas.</p>
        <div style="height: 2px; background-color: #ff0033; width: 80px; margin-top: 15px;"></div>
    </div>

    <div class="row g-4">

        <div class="col-md-6" data-aos="fade-right" data-aos-duration="1200">
            <div class="card card-cursed p-3 h-100 position-relative overflow-hidden" style="background-color: #0c0c0c; border: 1px solid #ff0033; border-radius: 0px;">
                <div class="row align-items-center g-3">
                    <div class="col-sm-5 text-center">
                        <img src="../images/calcabaggy.jpeg" class="img-fluid" alt="Coleção Heavy Pants" style="max-height: 220px; object-fit: cover;">
                    </div>
                    <div class="col-sm-7 text-center text-sm-start">
                        <span class="badge bg-danger mb-2" style="font-size: 0.7rem; letter-spacing: 1px;">DROP_01</span>
                        <h3 class="text-white text-uppercase fw-bold mb-2" style="font-size: 1.4rem; letter-spacing: 1px;">CALÇAS</h3>
                        <p class="small product-desc mb-4">Calças ultra largas, modelagem baggy, jeans estonado e detalhes utilitários pesados.</p>
                        <a href="calcas.php" class="btn btn-cursed w-100 text-uppercase" style="font-size: 0.85rem; letter-spacing: 1px;">Ver Produtos</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6" data-aos="fade-left" data-aos-duration="1200">
            <div class="card card-cursed p-3 h-100 position-relative overflow-hidden" style="background-color: #0c0c0c; border: 1px solid #ff0033; border-radius: 0px;">
                <div class="row align-items-center g-3">
                    <div class="col-sm-5 text-center">
                        <img src="../images/coturnodois.jpeg" class="img-fluid" alt="Coleção Boots" style="max-height: 220px; object-fit: cover;">
                    </div>
                    <div class="col-sm-7 text-center text-sm-start">
                        <span class="badge bg-danger mb-2" style="font-size: 0.7rem; letter-spacing: 1px;">ESSENTIALS</span>
                        <h3 class="text-white text-uppercase fw-bold mb-2" style="font-size: 1.4rem; letter-spacing: 1px;">CALÇADOS</h3>
                        <p class="small product-desc mb-4">Coturnos tratorados, solado industrial de alta borracha e couro com acabamento fosco.</p>
                        <a href="calcados.php" class="btn btn-cursed w-100 text-uppercase" style="font-size: 0.85rem; letter-spacing: 1px;">Ver Produtos</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6" data-aos="fade-right" data-aos-duration="1200">
            <div class="card card-cursed p-3 h-100 position-relative overflow-hidden" style="background-color: #0c0c0c; border: 1px solid #ff0033; border-radius: 0px;">
                <div class="row align-items-center g-3">
                    <div class="col-sm-5 text-center">
                        <img src="../images/gato.jpeg" class="img-fluid" alt="Coleção Oversized" style="max-height: 220px; object-fit: cover;">
                    </div>
                    <div class="col-sm-7 text-center text-sm-start">
                        <span class="badge bg-danger mb-2" style="font-size: 0.7rem; letter-spacing: 1px;">DROP_01</span>
                        <h3 class="text-white text-uppercase fw-bold mb-2" style="font-size: 1.4rem; letter-spacing: 1px;">Camisas</h3>
                        <p class="small product-desc mb-4">Malha pesada premium 100% algodão, ombros caídos e estampas com estética de rua.</p>
                        <a href="#" class="btn btn-cursed w-100 text-uppercase" style="font-size: 0.85rem; letter-spacing: 1px;">Ver Produtos</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6" data-aos="fade-left" data-aos-duration="1200">
            <div class="card card-cursed p-3 h-100 position-relative overflow-hidden" style="background-color: #0c0c0c; border: 1px solid #ff0033; border-radius: 0px;">
                <div class="row align-items-center g-3">
                    <div class="col-sm-5 text-center">
                        <img src="../images/correntedois.jpeg" class="img-fluid" alt="Coleção Cyber" style="max-height: 220px; object-fit: cover;">
                    </div>
                    <div class="col-sm-7 text-center text-sm-start">
                        <span class="badge bg-secondary mb-2" style="font-size: 0.7rem; letter-spacing: 1px; background-color: #222 !important;">EM BREVE</span>
                        <h3 class="text-white text-uppercase fw-bold mb-2" style="font-size: 1.4rem; letter-spacing: 1px;">ACESSÓRIOS</h3>
                        <p class="small product-desc mb-4">Cintos industriais, óculos escuros futuristas, correntes e acessórios urbanos.</p>
                        <button class="btn btn-outline-secondary w-100 text-uppercase disabled" style="font-size: 0.85rem; letter-spacing: 1px; border-radius: 0px;">Bloqueado</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

</div> <!-- Fecha o container -->
</main> <!-- Fecha a main do vídeo -->

<?php 
// Volta um nível de pasta para achar o diretório includes e carregar o rodapé
include '../includes/footer.php'; 
?>
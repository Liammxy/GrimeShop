<?php 
// Caminho absoluto para os includes de dentro da pasta paginas
include '../includes/header.php'; 
?>

<main class="position-relative overflow-hidden pt-0 pb-0" style="min-height: 75vh;">

    <video autoplay muted loop playsinline class="position-absolute top-50 start-50 translate-middle w-100 h-100" style="object-fit: cover; z-index: 1; pointer-events: none;">
        <source src="../images/fundo.mp4" type="video/mp4">
    </video>

    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(18, 18, 18, 0.75); z-index: 2;"></div>

    <div class="container position-relative" style="z-index: 3; py-5;">

<div class="container my-4">
    <div class="mb-5 mt-4">
        <h1 class="display-5 fw-bold text-white text-uppercase mb-2" style="letter-spacing: 2px;">[ ACESSÓRIOS ]</h1>
        <p class="text-light" style="font-weight: 300; opacity: 0.85;">Engrenagens urbanas para blindar o seu visual.</p>
        <div style="height: 2px; background-color: #ff0033; width: 80px; margin-top: 15px;"></div>
    </div>

    <div class="row g-4">
        
        <div class="col-md-4">
            <div class="card card-cursed p-3 h-100">
                <img src="/ProjetoGrimeShop/images/cinto.jpeg" class="card-img-top" alt="Cinto Industrial Trad">
                <div class="card-body p-0 text-center">
                    <h5 class="product-title">Cinto Industrial Tape</h5>
                    <p class="small product-desc mb-2">Cinto de lona ultra resistente com fivela de engate rápido em metal preto.</p>
                    <p class="product-price">R$ 49,90</p>
                    <button class="btn btn-cursed w-100">Adicionar ao Carrinho</button>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-cursed p-3 h-100">
                <img src="/ProjetoGrimeShop/images/corrente.jpeg" class="card-img-top" alt="Corrente de Calça Cubana">
                <div class="card-body p-0 text-center">
                    <h5 class="product-title">Corrente Double Chain</h5>
                    <p class="small product-desc mb-2">Corrente dupla em aço cirúrgico com mosquetões reforçados para prender na calça baggy.</p>
                    <p class="product-price">R$ 39,90</p>
                    <button class="btn btn-cursed w-100">Adicionar ao Carrinho</button>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-cursed p-3 h-100">
                <img src="/ProjetoGrimeShop/images/oculos.jpeg" class="card-img-top" alt="Óculos Escuros Cyber">
                <div class="card-body p-0 text-center">
                    <h5 class="product-title">Óculos Cyber Shade</h5>
                    <p class="small product-desc mb-2">Lentes escuras com proteção UV400 e armação futurista em acetato preto fosco.</p>
                    <p class="product-price">R$ 79,90</p>
                    <button class="btn btn-cursed w-100">Adicionar ao Carrinho</button>
                </div>
            </div>
        </div>

    </div>
</div>

</div> <!-- Fecha o container -->
</main> <!-- Fecha a main do vídeo -->

<?php 
// Inclui o rodapé padronizado
include '../includes/footer.php'; 
?>
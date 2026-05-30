<?php 
// Puxa o cabeçalho estilizado
include 'includes/header.php'; 
?>

<main class="position-relative overflow-hidden py-5" style="min-height: 75vh;">

    <video autoplay muted loop playsinline class="position-absolute top-50 start-50 translate-middle w-100 h-100" style="object-fit: cover; z-index: 1; pointer-events: none;">
        <source src="images/fundo.mp4" type="video/mp4">
    </video>

    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(18, 18, 18, 0.75); z-index: 2;"></div>

    <div class="container position-relative" style="z-index: 3;">

<div class="container my-4">

    <div class="p-5 mb-5 text-center d-flex align-items-center" style="background-color: #0c0c0c; border: 1px solid #ff0033; min-height: 300px;">
        <div class="py-2 w-100">
            <h1 class="display-4 fw-bold mb-3 text-white" style="letter-spacing: 2px;">REVOLUCIONE SEU ESTILO</h1>
            <p class="fs-5 text-light mb-4 mx-auto" style="font-weight: 300; opacity: 0.85; max-width: 700px;">
                Aguarde o próximo drop. Coturnos pesados, calças baggy e estética urbana underground.
            </p>
            <button class="btn btn-cursed" type="button">Ver Catálogo</button>
        </div>
    </div>

    <h2 class="mb-4 text-uppercase" style="font-size: 1.3rem; letter-spacing: 1px; color: #888; padding-left: 0;">// Lançamentos</h2>

    <div class="row g-4">
        
        <div class="col-md-4" data-aos="fade-right">
            <div class="card card-cursed p-3 h-100">
                <img src="images/coturnoinicial.jpeg" class="card-img-top" alt="Coturno Plataforma Dark">
                <div class="card-body p-0 text-center">
                    <h5 class="product-title">Coturno Plataforma Dark</h5>
                    <p class="small product-desc mb-2">Couro legítimo, solado tratorado industrial de alta resistência.</p>
                    <p class="product-price">R$ 249,90</p>
                    <button class="btn btn-cursed w-100">Adicionar ao Carrinho</button>
                </div>
            </div>
        </div>

        <div class="col-md-4" data-aos="fade-up">
            <div class="card card-cursed p-3 h-100">
                <img src="images/calcabaggy.jpeg" class="card-img-top" alt="Calça Baggy Denim">
                <div class="card-body p-0 text-center">
                    <h5 class="product-title">Calça Baggy Denim</h5>
                    <p class="small product-desc mb-2">Corte ultra largo e confortável, com estética estonada preta.</p>
                    <p class="product-price">R$ 189,90</p>
                    <button class="btn btn-cursed w-100">Adicionar ao Carrinho</button>
                </div>
            </div>
        </div>

        <div class="col-md-4" data-aos="fade-left">
            <div class="card card-cursed p-3 h-100">
                <img src="images/camisagravata.jpeg" class="card-img-top" alt="Camisa Oversized Grime">
                <div class="card-body p-0 text-center">
                    <h5 class="product-title">Camisa Oversized Grime</h5>
                    <p class="small product-desc mb-2">Malha pesada 100% algodão premium com modelagem de rua.</p>
                    <p class="product-price">R$ 89,90</p>
                    <button class="btn btn-cursed w-100">Adicionar ao Carrinho</button>
                </div>
            </div>
        </div>

    </div>
</div>
</main>
<?php 
// Puxa o rodapé
include 'includes/footer.php'; 
?>
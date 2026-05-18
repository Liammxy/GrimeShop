<?php 
// Caminho absoluto para os includes de dentro da pasta paginas
include '../includes/header.php'; 
?>

<div class="container my-4">
    <div class="mb-5 mt-4">
        <h1 class="display-5 fw-bold text-white text-uppercase mb-2" style="letter-spacing: 2px;">[ ACESSÓRIOS ]</h1>
        <p class="text-light" style="font-weight: 300; opacity: 0.85;">Engrenagens urbanas para blindar o seu visual.</p>
        <div style="height: 2px; background-color: #ff0033; width: 80px; margin-top: 15px;"></div>
    </div>

    <div class="row g-4">
        
        <div class="col-md-4">
            <div class="card card-cursed p-3 h-100">
                <img src="https://images.unsplash.com/photo-1624222247344-550fb8ecf782?q=80&w=600" class="card-img-top" alt="Cinto Industrial Trad">
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
                <img src="https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?q=80&w=600" class="card-img-top" alt="Corrente de Calça Cubana">
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
                <img src="https://images.unsplash.com/photo-1511499767150-a48a237f0083?q=80&w=600" class="card-img-top" alt="Óculos Escuros Cyber">
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

<?php 
// Inclui o rodapé padronizado
include '../includes/footer.php'; 
?>
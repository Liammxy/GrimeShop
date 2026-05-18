<?php 
// Puxa o cabeçalho padronizado do diretório includes
include '../includes/header.php'; 
?>

<div class="container my-4">
    <div class="mb-5 mt-4">
        <h1 class="display-5 fw-bold text-white text-uppercase mb-2" style="letter-spacing: 2px;">[ SEU_CARRINHO ]</h1>
        <p class="text-light" style="font-weight: 300; opacity: 0.85;">Confira os itens selecionados antes de fechar o pedido.</p>
        <div style="height: 2px; background-color: #ff0033; width: 80px; margin-top: 15px;"></div>
    </div>

    <div class="row g-4">
        
        <div class="col-md-8">
            
            <div class="card p-3 mb-3" style="background-color: #0c0c0c; border: 1px solid #1a1a1a; border-radius: 0px;">
                <div class="row align-items-center text-center text-sm-start">
                    <div class="col-sm-2 mb-3 mb-sm-0">
                        <img src="../images/calcabaggy.jpeg" class="img-fluid" alt="Calça Baggy" style="max-height: 80px; object-fit: cover;">
                    </div>
                    <div class="col-sm-5 mb-2 mb-sm-0">
                        <h5 class="text-white text-uppercase fw-bold mb-1" style="font-size: 1rem; letter-spacing: 0.5px;">Calça Baggy Denim</h5>
                        <p class="mb-0" style="font-size: 0.8rem; color: #888;">Tamanho: G | Cor: Preto Estonado</p>
                    </div>
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <span class="text-light small">Qtd: 1</span>
                    </div>
                    <div class="col-sm-2 text-sm-end">
                        <span class="text-danger fw-bold" style="letter-spacing: 0.5px;">R$ 189,90</span>
                    </div>
                </div>
            </div>

            <div class="card p-3 mb-3" style="background-color: #0c0c0c; border: 1px solid #1a1a1a; border-radius: 0px;">
                <div class="row align-items-center text-center text-sm-start">
                    <div class="col-sm-2 mb-3 mb-sm-0">
                        <img src="https://images.unsplash.com/photo-1608256246200-53e635b5b65f?q=80&w=600" class="img-fluid" alt="Coturno Dark" style="max-height: 80px; object-fit: cover;">
                    </div>
                    <div class="col-sm-5 mb-2 mb-sm-0">
                        <h5 class="text-white text-uppercase fw-bold mb-1" style="font-size: 1rem; letter-spacing: 0.5px;">Coturno Plataforma Dark</h5>
                        <p class="mb-0" style="font-size: 0.8rem; color: #888;">Tamanho: 41 | Solado Tratorado</p>
                    </div>
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <span class="text-light small">Qtd: 1</span>
                    </div>
                    <div class="col-sm-2 text-sm-end">
                        <span class="text-danger fw-bold" style="letter-spacing: 0.5px;">R$ 249,90</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-4">
            <div class="card p-4" style="background-color: #0c0c0c; border: 1px solid #ff0033; border-radius: 0px;">
                <h4 class="text-white text-uppercase fw-bold mb-4" style="font-size: 1.2rem; letter-spacing: 1px;">// RESUMO</h4>
                
                <div class="d-flex justify-content-between mb-2 pb-2" style="border-bottom: 1px solid #1a1a1a;">
                    <span style="color: #b5b5b5; font-size: 0.9rem;">Subtotal</span>
                    <span class="text-white small">R$ 439,80</span>
                </div>
                
                <div class="d-flex justify-content-between mb-3 pb-2" style="border-bottom: 1px solid #1a1a1a;">
                    <span style="color: #b5b5b5; font-size: 0.9rem;">Envio (Sedex)</span>
                    <span class="text-success small">GRÁTIS</span>
                </div>

                <div class="d-flex justify-content-between mb-4">
                    <span class="text-white fw-bold text-uppercase" style="letter-spacing: 0.5px;">Total Geral</span>
                    <span class="text-danger fw-bold" style="font-size: 1.2rem;">R$ 439,80</span>
                </div>

                <button class="btn btn-cursed w-100 text-uppercase fw-bold py-2 mb-2" style="letter-spacing: 1px; font-size: 0.9rem;">Finalizar Pedido</button>
                <a href="/ProjetoGrimeShop/index.php" class="btn btn-outline-secondary w-100 text-uppercase small" style="border-radius: 0px; font-size: 0.75rem; letter-spacing: 0.5px; color: #b5b5b5; border-color: #222;">Continuar Comprando</a>
            </div>
        </div>

    </div>
</div>

<?php 
// Puxa o rodapé do diretório includes
include '../includes/footer.php'; 
?>
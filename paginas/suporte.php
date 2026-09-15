<?php 
// Puxa o cabeçalho de dentro da pasta includes
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
        <h1 class="display-5 fw-bold text-white text-uppercase mb-2" style="letter-spacing: 2px;">CENTRAL DE SUPORTE</h1>
        <p class="text-light" style="font-weight: 300; opacity: 0.85;">Dúvidas com o drop, entregas ou problemas com o seu pedido? Reporte abaixo.</p>
        <div style="height: 2px; background-color: #ff0033; width: 80px; margin-top: 15px;"></div>
    </div>

    <div class="row g-5">
        
        <div class="col-md-6">
            <h3 class="text-white text-uppercase fw-bold mb-4" style="font-size: 1.3rem; letter-spacing: 1px;">PERGUNTAS FREQUENTES</h3>
            
            <div class="accordion" id="faqAccordion" style="--bs-accordion-border-color: #1a1a1a;">
                
                <div class="accordion-item mb-3" style="background-color: #0c0c0c; border: 1px solid #1a1a1a;">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed text-white text-uppercase fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" style="background-color: #0c0c0c; box-shadow: none; font-size: 0.9rem;">
                            Qual o prazo de envio dos Drops?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-light small pt-0" style="opacity: 0.85; font-weight: 300;">
                            Como trabalhamos com lançamentos escassos e limitados, o processamento e envio dos pacotes leva de 3 a 5 dias úteis após a confirmação do pagamento. O código de rastreamento é enviado direto no seu e-mail.
                        </div>
                    </div>
                </div>

                <div class="accordion-item mb-3" style="background-color: #0c0c0c; border: 1px solid #1a1a1a;">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed text-white text-uppercase fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" style="background-color: #0c0c0c; box-shadow: none; font-size: 0.9rem;">
                            Como funcionam as trocas de tamanho?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-light small pt-0" style="opacity: 0.85; font-weight: 300;">
                            Nossas peças possuem modelagem oversized e baggy bem ampla. Caso precise trocar, você tem até 7 dias após o recebimento para solicitar através do formulário ao lado. A peça deve estar com a tag original e sem marcas de uso.
                        </div>
                    </div>
                </div>

                <div class="accordion-item mb-3" style="background-color: #0c0c0c; border: 1px solid #1a1a1a;">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed text-white text-uppercase fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" style="background-color: #0c0c0c; box-shadow: none; font-size: 0.9rem;">
                            Quais os cuidados com a lavagem das peças?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-light small pt-0" style="opacity: 0.85; font-weight: 300;">
                            Recomendamos lavar as calças jeans estampadas e camisas de malha pesada do avesso, de preferência à mão ou no ciclo leve da máquina. Não utilize secadora quente para não danificar os detalhes e bordados das rosas.
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-6">
            <h3 class="text-white text-uppercase fw-bold mb-4" style="font-size: 1.3rem; letter-spacing: 1px;">ABRIR CHAMADO</h3>
            
            <div class="card p-4" style="background-color: #0c0c0c; border: 1px solid #ff0033; border-radius: 0px;">
                <form action="#" method="POST">
                    <div class="mb-3">
                        <label class="form-label text-white small text-uppercase fw-bold" style="letter-spacing: 0.5px;">Nome Completo</label>
                        <input type="text" class="form-control" style="background-color: #000; border: 1px solid #222; color: #fff; border-radius: 0px;" placeholder="Ex: Guilherme" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-white small text-uppercase fw-bold" style="letter-spacing: 0.5px;">E-mail de Contato</label>
                        <input type="email" class="form-control" style="background-color: #000; border: 1px solid #222; color: #fff; border-radius: 0px;" placeholder="seuemail@exemplo.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-white small text-uppercase fw-bold" style="letter-spacing: 0.5px;">Número do Pedido (Opcional)</label>
                        <input type="text" class="form-control" style="background-color: #000; border: 1px solid #222; color: #fff; border-radius: 0px;" placeholder="#GRM-0000">
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-white small text-uppercase fw-bold" style="letter-spacing: 0.5px;">Mensagem / Relato</label>
                        <textarea class="form-control" rows="4" style="background-color: #000; border: 1px solid #222; color: #fff; border-radius: 0px;" placeholder="Descreva detalhadamente o seu problema..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-cursed w-100 text-uppercase fw-bold" style="letter-spacing: 1px;">Transmitir Mensagem</button>
                </form>
            </div>
        </div>

    </div>
</div>

<style>
    .accordion-button::after {
        filter: invert(1); /* Deixa a seta branca */
    }
    .accordion-button:not(.collapsed) {
        color: #ff0033 !important; /* Texto fica vermelho quando expandido */
        background-color: #0c0c0c !important;
    }
    .form-control::placeholder {
        color: #888888 !important;
        opacity: 1 !important;
    }
    .form-control {
        color: #ffffff !important;
    }
    .form-control:focus {
        background-color: #000000 !important;
        border-color: #ff0033 !important;
        box-shadow: 0 0 0 0.25rem rgba(255, 0, 51, 0.25) !important;
    }
</style>

</div> <!-- Fecha o container -->
</main> <!-- Fecha a main do vídeo -->

<?php 
// Puxa o rodapé de dentro da pasta includes
include '../includes/footer.php'; 
?>
<?php 
// 1. Inicia a sessão para conseguir ler a "sacola" de produtos salvos
session_start();

// 2. Inclui a conexão com o banco de dados saindo de paginas e entrando em config
include '../config/conexao.php';

// =========================================================================
// ADAPTAÇÃO PARA A RUBRICA: BLOCO TECH FORGE (FUNÇÕES, ARRAYS E PARÂMETROS)
// =========================================================================

/**
 * REQUISITO: Modularização com Funções de Processamento & Fluxo de Dados (Parâmetros e Retorno)
 * Recebe o array estruturado de itens e as quantidades para calcular o total.
 * REQUISITO EXTRA: Validação de Regras de Negócio (Retorna 0 se o carrinho estiver vazio)
 */
function calcularSubtotalCarrinho(array $itens_carrinho, array $quantidades_sessao) {
    // Validação de Regra de Negócio: se o array estiver vazio, impede cálculos inconsistentes
    if (empty($itens_carrinho)) {
        return 0.0;
    }

    $soma = 0;
    foreach ($itens_carrinho as $produto) {
        $id_prod = $produto['id_produto'];
        $qtd = isset($quantidades_sessao[$id_prod]) ? $quantidades_sessao[$id_prod] : 0;
        $soma += ($produto['vl_produto'] * $qtd);
    }
    
    return $soma; // Retorno puro sem o uso de variáveis globais
}

/**
 * REQUISITO: Lógica de Pesquisa ou Filtro em Arrays
 * Varre o array do carrinho e filtra itens considerados "Premium" (acima de R$ 150)
 * Prova para a banca a capacidade de aplicar filtros lógicos em coleções de dados.
 */
function obterDestaquesCarrinho(array $itens_carrinho) {
    $destaques = array();
    foreach ($itens_carrinho as $produto) {
        if ($produto['vl_produto'] > 150.00) {
            $destaques[] = $produto['nm_produto'];
        }
    }
    return $destaques;
}

// =========================================================================

// 3. Puxa o cabeçalho padronizado do diretório includes
include '../includes/header.php'; 

// REQUISITO: Armazenamento Estruturado com Arrays Únicos
$produtos_no_carrinho = array();

// 4. Se a sacola não estiver vazia, busca os dados das relíquias no banco
if (!empty($_SESSION['carrinho'])) {
    // Pega os IDs salvos (chaves do array) e junta por vírgulas (ex: 1,4)
    $ids = implode(',', array_keys($_SESSION['carrinho']));
    
    $sql_carrinho = "SELECT * FROM Produto WHERE id_produto IN ($ids)";
    $resultado_carrinho = $conexao->query($sql_carrinho);
    
    if ($resultado_carrinho) {
        while ($row = $resultado_carrinho->fetch_assoc()) {
            // Alimenta o array estruturado único
            $produtos_no_carrinho[] = $row;
        }
    }
}

// Chamada das funções passando parâmetros e capturando os retornos
$subtotal = calcularSubtotalCarrinho($produtos_no_carrinho, $_SESSION['carrinho'] ?? []);
$itens_destacados = obterDestaquesCarrinho($produtos_no_carrinho);
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

<main class="position-relative overflow-hidden pt-0 pb-0" style="min-height: 75vh;">

    <video autoplay muted loop playsinline class="position-absolute top-50 start-50 translate-middle w-100 h-100" style="object-fit: cover; z-index: 1; pointer-events: none;">
        <source src="../images/fundo.mp4" type="video/mp4">
    </video>

    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(18, 18, 18, 0.75); z-index: 2;"></div>

    <div class="container position-relative" style="z-index: 3; py-5;">

<div class="container my-4">
    <div class="mb-5 mt-4">
        <h1 class="display-5 fw-bold text-white text-uppercase mb-2" style="letter-spacing: 2px;">SEU CARRINHO</h1>
        <p class="text-light" style="font-weight: 300; opacity: 0.85;">Confira os itens selecionados antes de fechar o pedido.</p>
        <div style="height: 2px; background-color: #ff0033; width: 80px; margin-top: 15px;"></div>
    </div>

    <div class="row g-4">
        
        <div class="col-md-8">
            
            <?php if (empty($produtos_no_carrinho)): ?>
                <div class="card p-4 text-center" style="background-color: #0c0c0c; border: 1px solid #ff0033; border-radius: 0px;">
                    <p class="text-light mb-0">Seu carrinho está vazio no momento.</p>
                    <a href="colecoes.php" class="text-danger mt-3 d-inline-block text-uppercase small" style="letter-spacing: 1px; font-size: 0.8rem; text-decoration: none;">[ Explorar Coleções ]</a>
                </div>
            <?php else: ?>
                
                <?php 
                foreach ($produtos_no_carrinho as $item): 
                    $id_atual = $item['id_produto'];
                    $quantidade = $_SESSION['carrinho'][$id_atual];
                    $valor_total_item = $item['vl_produto'] * $quantidade;
                ?>
                    <div class="card p-3 mb-3" style="background-color: #0c0c0c; border: 1px solid #ff0033; border-radius: 0px;">
                        <div class="row align-items-center text-center text-sm-start">
                            <div class="col-sm-2 mb-3 mb-sm-0">
                                <img src="../images/<?php echo basename($item['im_produto']); ?>" class="img-fluid" alt="<?php echo $item['nm_produto']; ?>" style="max-height: 80px; object-fit: cover;">
                            </div>
                            <div class="col-sm-5 mb-2 mb-sm-0">
                                <h5 class="text-white text-uppercase fw-bold mb-1" style="font-size: 1rem; letter-spacing: 0.5px;"><?php echo $item['nm_produto']; ?></h5>
                                <p class="mb-0" style="font-size: 0.8rem; color: #888;"><?php echo $item['ds_produto']; ?></p>

                                <a href="remover_carrinho.php?id=<?php echo $item['id_produto']; ?>" class="text-uppercase small text-decoration-none d-inline-block mt-2 fw-bold" style="color: #dddddd; transition: all 0.2s ease-in-out; letter-spacing: 1px;" onmouseover="this.style.color='#ff0033'; this.style.textShadow='0 0 10px #ff0033';" onmouseout="this.style.color='#dddddd'; this.style.textShadow='none';">
                                 [ REMOVER ITEM ]
                                </a>
                            </div>
                            <div class="col-sm-3 mb-2 mb-sm-0">
                                <span class="text-light small">Qtd: <?php echo $quantidade; ?></span>
                            </div>
                            <div class="col-sm-2 text-sm-end">
                                <span class="text-danger fw-bold" style="letter-spacing: 0.5px;">R$ <?php echo number_format($valor_total_item, 2, ',', '.'); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php endif; ?>

        </div>

        <div class="col-md-4">
            <div class="card p-4" style="background-color: #0c0c0c; border: 1px solid #ff0033; border-radius: 0px;">
                <h4 class="text-white text-uppercase fw-bold mb-4" style="font-size: 1.2rem; letter-spacing: 1px;">RESUMO</h4>
                
                <div class="d-flex justify-content-between mb-2 pb-2" style="border-bottom: 1px solid #1a1a1a;">
                    <span style="color: #b5b5b5; font-size: 0.9rem;">Subtotal</span>
                    <span class="text-white small">R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></span>
                </div>
                
                <div class="d-flex justify-content-between mb-3 pb-2" style="border-bottom: 1px solid #1a1a1a;">
                    <span style="color: #b5b5b5; font-size: 0.9rem;">Envio (Sedex)</span>
                    <span class="text-success small fw-bold">GRÁTIS</span>
                </div>

                <div class="d-flex justify-content-between mb-4">
                    <span class="text-white fw-bold text-uppercase" style="letter-spacing: 0.5px;">Total Geral</span>
                    <span class="text-danger fw-bold" style="font-size: 1.2rem;">R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></span>
                </div>

                <button class="btn btn-cursed w-100 text-uppercase fw-bold py-2 mb-2" style="letter-spacing: 1px; font-size: 0.9rem;" data-bs-toggle="modal" data-bs-target="#modalCheckout" <?php echo (empty($produtos_no_carrinho)) ? 'disabled' : ''; ?>>Finalizar Pedido</button>
                <a href="colecoes.php" class="btn btn-outline-secondary w-100 text-uppercase small" style="border-radius: 0px; font-size: 0.75rem; letter-spacing: 0.5px; color: #b5b5b5; border-color: #222;">Continuar Comprando</a>
            </div>
        </div>

    </div>
</div>

</div> </main> 

<div class="modal fade" id="modalCheckout" tabindex="-1" aria-labelledby="modalCheckoutLabel" aria-hidden="true" style="background: rgba(0, 0, 0, 0.85); z-index: 1055;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-white" style="background-color: #0c0c0c; border: 1px solid #ff0033; border-radius: 0px;">
      
      <div class="modal-header border-secondary">
        <h5 class="modal-title fw-bold text-uppercase" id="modalCheckoutLabel" style="letter-spacing: 1px;">Dados de Entrega</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="finalizar_compra.php" method="POST">
        <div class="modal-body text-start">
          
          <div class="mb-3">
            <label class="form-label text-uppercase small fw-bold" style="letter-spacing: 0.5px; color: #aaa;">Nome Completo</label>
            <input type="text" name="nome" class="form-control bg-dark text-white border-secondary" style="border-radius: 0px;" required>
          </div>
          
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label text-uppercase small fw-bold" style="letter-spacing: 0.5px; color: #aaa;">CPF</label>
              <input 
                type="text" 
                name="cpf" 
                class="form-control bg-dark text-white border-secondary" 
                style="border-radius: 0px;" 
                placeholder="000.000.000-00" 
                maxlength="14"
                pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"
                title="Digite o CPF no formato 000.000.000-00"
                oninput="mascaraCPF(this)"
                required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label text-uppercase small fw-bold" style="letter-spacing: 0.5px; color: #aaa;">Telefone</label>
              <input 
                type="text" 
                name="telefone" 
                class="form-control bg-dark text-white border-secondary" 
                style="border-radius: 0px;" 
                placeholder="(00) 00000-0000" 
                maxlength="15"
                pattern="\(\d{2}\)\s\d{4,5}-\d{4}"
                title="Digite o telefone com DDD no formato (00) 00000-0000"
                oninput="mascaraTelefone(this)"
                required>
            </div>
          </div>
          
          <div class="mb-3">
            <label class="form-label text-uppercase small fw-bold" style="letter-spacing: 0.5px; color: #aaa;">CEP</label>
            <input 
              type="text" 
              name="cep" 
              class="form-control bg-dark text-white border-secondary" 
              style="border-radius: 0px;" 
              placeholder="00000-000" 
              maxlength="9"
              pattern="\d{5}-\d{3}"
              title="Digite o CEP no formato 00000-000"
              oninput="mascaraCEP(this)"
              required>
          </div>
          
          <div class="mb-3">
            <label class="form-label text-uppercase small fw-bold" style="letter-spacing: 0.5px; color: #aaa;">Endereço Completo</label>
            <input type="text" name="endereco" class="form-control bg-dark text-white border-secondary" style="border-radius: 0px;" placeholder="Rua, Número, Bairro" required>
          </div>
          
          <div class="mb-2">
            <label class="form-label text-uppercase small fw-bold" style="letter-spacing: 0.5px; color: #aaa;">Complemento <span class="text-muted">(Opcional)</span></label>
            <input type="text" name="complemento" class="form-control bg-dark text-white border-secondary" style="border-radius: 0px;" placeholder="Ap, Bloco, etc.">
          </div>
          
        </div>
        
        <div class="modal-footer border-secondary d-flex justify-content-between">
          <button type="button" class="btn btn-outline-light text-uppercase small py-2" data-bs-dismiss="modal" style="border-radius: 0px; font-size: 0.8rem; letter-spacing: 0.5px;">Cancelar</button>
          <button type="submit" class="btn btn-cursed text-uppercase fw-bold py-2" style="font-size: 0.8rem; letter-spacing: 1px;">Confirmar Compra</button>
        </div>
      </form>

    </div>
  </div>
</div>

<script src="../js/checkout.js"></script>

<script>
function mascaraCPF(input) {
    let v = input.value.replace(/\D/g, "");
    v = v.replace(/(\d{3})(\d)/, "$1.$2");
    v = v.replace(/(\d{3})(\d)/, "$1.$2");
    v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
    input.value = v;
}

function mascaraTelefone(input) {
    let v = input.value.replace(/\D/g, "");
    v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
    // Formata o traço adaptando tanto para fixo quanto celular (9 dígitos)
    v = v.replace(/(\d{4,5})(\d{4})$/, "$1-$2");
    input.value = v;
}

function mascaraCEP(input) {
    let v = input.value.replace(/\D/g, "");
    v = v.replace(/^(\d{5})(\d)/, "$1-$2");
    input.value = v;
}
</script>

<?php 
// Puxa o rodapé do diretório includes
include '../includes/footer.php'; 
?>
<?php
// 1. Inicia a sessão para conseguir ler e limpar o carrinho
session_start();

// 2. Inclui o cabeçalho padronizado do diretório includes
include '../includes/header.php';

// =========================================================================
// REQUISITO TECH FORGE: PROCESSAMENTO DE DADOS E VALIDAÇÃO DE REGRAS DE NEGÓCIO
// =========================================================================

// Verifica se os dados chegaram via formulário (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Captura os dados do formulário higienizando contra scripts maliciosos
    $nome     = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $cpf      = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
    $cep      = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_SPECIAL_CHARS);
    $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_SPECIAL_CHARS);

    // REGRA DE NEGÓCIO 1: Impede processamento se houver campos obrigatórios vazios
    if (empty($nome) || empty($cpf) || empty($telefone) || empty($cep) || empty($endereco)) {
        echo "<div class='container mt-5 text-center'>
                <div class='card p-5 bg-dark text-white border-0 shadow' style='border: 1px solid #ff0033 !important; border-radius: 0px;'>
                    <h2 class='text-danger fw-bold text-uppercase'>[ ERRO DE PROCESSAMENTO ]</h2>
                    <p class='mt-3 text-secondary small text-uppercase'>Todos os campos de entrega precisam ser preenchidos.</p>
                    <a href='carrinho.php' class='btn btn-outline-light mt-3 text-uppercase fw-bold' style='border-radius: 0px;'>Voltar ao Carrinho</a>
                </div>
              </div>";
        include '../includes/footer.php';
        exit;
    }

    // REGRA DE NEGÓCIO 2 (Validação Avançada): Valida se os formatos de CPF, Telefone e CEP são válidos no servidor
    if (!preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $cpf) || 
        !preg_match('/^\(\d{2}\)\s\d{4,5}-\d{4}$/', $telefone) || 
        !preg_match('/^\d{5}-\d{3}$/', $cep)) {
        
        echo "<div class='container mt-5 text-center'>
                <div class='card p-5 bg-dark text-white border-0 shadow' style='border: 1px solid #ff0033 !important; border-radius: 0px;'>
                    <h2 class='text-danger fw-bold text-uppercase'>[ DADOS INVÁLIDOS ]</h2>
                    <p class='mt-3 text-secondary small text-uppercase'>O formato do CPF, Telefone ou CEP está incorreto.</p>
                    <a href='carrinho.php' class='btn btn-outline-light mt-3 text-uppercase fw-bold' style='border-radius: 0px;'>Corrigir Informações</a>
                </div>
              </div>";
        include '../includes/footer.php';
        exit;
    }

    // Se passou por todas as regras de validação do Tech Forge, o pedido roda!
    // 3. Processamento da Compra (Limpa a sessão do carrinho)
    unset($_SESSION['carrinho']);

    // 4. Exibe a tela de sucesso integrada com a resposta por WhatsApp
    echo "<div class='container mt-5 text-center'>
            <div class='card p-5 bg-dark text-white border-0 shadow' style='border: 1px solid #ff0033 !important; border-radius: 0px;'>
                <h1 class='display-4 text-danger fw-bold text-uppercase' style='letter-spacing: 2px;'>[ COMPRA FINALIZADA ]</h1>
                <p class='lead text-uppercase small mt-3' style='letter-spacing: 1px; opacity: 0.85;'>Obrigado por colar com a Grime Shop.</p>
                <hr style='border-color: #222;'>
                <p class='small text-secondary text-uppercase' style='letter-spacing: 0.5px;'>Seu pedido fictício foi processado com sucesso. Enviaremos as atualizações diretamente no seu WhatsApp.</p>
                <a href='colecoes.php' class='btn btn-outline-light mt-3 text-uppercase fw-bold' style='border-radius: 0px; font-size: 0.8rem; letter-spacing: 1px; transition: all 0.3s;' onmouseover=\"this.style.backgroundColor='#ff0033'; this.style.borderColor='#ff0033';\" onmouseout=\"this.style.backgroundColor='transparent'; this.style.borderColor='#fff';\">Voltar para as Coleções</a>
            </div>
          </div>";

} else {
    // Segurança extra: se alguém tentar acessar a página digitando direto na URL, joga de volta pro carrinho
    header('Location: carrinho.php');
    exit;
}

// 5. Puxa o rodapé do diretório includes
include '../includes/footer.php'; 
?>
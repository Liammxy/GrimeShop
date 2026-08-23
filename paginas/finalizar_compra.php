<?php
session_start();

// resposta para o formato JSON exigido pra API
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Captura e saanatiza os dados do formulário
    $nome     = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $cpf      = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
    $cep      = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_SPECIAL_CHARS);
    $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_SPECIAL_CHARS);

    // REGRA DE NEGÓCIO 1: Validação de campos obrigatórios
    if (empty($nome) || empty($cpf) || empty($telefone) || empty($cep) || empty($endereco)) {
        echo json_encode([
            'sucesso' => false,
            'mensagem' => 'Todos os campos de entrega precisam ser preenchidos.'
        ]);
        exit;
    }

    // REGRA DE NEGÓCIO 2: Validação de formatos (CPF, Telefone, CEP)
    if (!preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $cpf) || 
        !preg_match('/^\(\d{2}\)\s\d{4,5}-\d{4}$/', $telefone) || 
        !preg_match('/^\d{5}-\d{3}$/', $cep)) {
        
        echo json_encode([
            'sucesso' => false,
            'mensagem' => 'O formato do CPF, Telefone ou CEP está incorreto.'
        ]);
        exit;
    }

    // Processamento da compra: limpa a sessão do carrinho
    unset($_SESSION['carrinho']);

    // Retorna resposta de sucesso para o try/catch do JavaScript
    echo json_encode([
        'sucesso' => true,
        'mensagem' => 'COMPRA FINALIZADA! Obrigado por colar com a Grime Shop. Enviaremos atualizações no seu WhatsApp.'
    ]);
    exit;

} else {
    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Acesso negado. Método de requisição inválido.'
    ]);
    exit;
}
?>
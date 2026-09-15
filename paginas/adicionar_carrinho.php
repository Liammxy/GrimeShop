<?php
// Garante que a sessão só seja iniciada se ainda não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Limpa qualquer saída anterior (espaços em branco/warnings) para não quebrar o JSON
if (ob_get_length()) {
    ob_clean();
}

header('Content-Type: application/json; charset=utf-8');

// Garante a existência do carrinho na sessão
if (!isset($_SESSION['carrinho']) || !is_array($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Captura a ID enviada tanto por GET quanto por POST
$id_produto = 0;
if (isset($_GET['id'])) {
    $id_produto = intval($_GET['id']);
} elseif (isset($_POST['id'])) {
    $id_produto = intval($_POST['id']);
}

// Se recebeu uma ID válida, adiciona ou incrementa a quantidade
if ($id_produto > 0) {
    if (isset($_SESSION['carrinho'][$id_produto])) {
        $_SESSION['carrinho'][$id_produto] += 1;
    } else {
        $_SESSION['carrinho'][$id_produto] = 1;
    }
}

// Soma a quantidade total de itens no carrinho
$total_itens = array_sum($_SESSION['carrinho']);

// Retorna a resposta JSON limpa
echo json_encode([
    'status' => true,
    'total_itens' => $total_itens,
    'carrinho' => $_SESSION['carrinho']
]);
exit;
<?php
// Inicia a sessão para o navegador lembrar dos produtos adicionados
session_start();

// Verifica se o ID do produto foi passado na URL
if (isset($_GET['id'])) {
    $id_produto = intval($_GET['id']);

    // Se a sacola (carrinho) não existir na memória ainda, cria uma vazia
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = array();
    }

    // Se o produto já estiver na sacola, soma +1 na quantidade
    if (isset($_SESSION['carrinho'][$id_produto])) {
        $_SESSION['carrinho'][$id_produto]++;
    } else {
        // Se for a primeira vez que adiciona esse produto, começa com a quantidade 1
        $_SESSION['carrinho'][$id_produto] = 1;
    }
}

// Faz a página atualizar e voltar exatamente para onde o cliente estava antes
if (isset($_SERVER['HTTP_REFERER'])) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    header("Location: colecoes.php");
}
exit;
<?php
// Inicia a sessão para acessar a memória do carrinho
session_start();

// Verifica se o ID do produto que deve ser removido foi passado na URL
if (isset($_GET['id'])) {
    $id_produto = intval($_GET['id']);

    // Se o produto existir dentro da sacola, deleta ele da sessão
    if (isset($_SESSION['carrinho'][$id_produto])) {
        unset($_SESSION['carrinho'][$id_produto]);
    }
}

// Redireciona o cliente de volta para a página do carrinho atualizada
header("Location: carrinho.php");
exit;
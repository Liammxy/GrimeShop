<?php
// Inicia a sessão para o navegador lembrar dos produtos adicionados
session_start();

// 1. IMPORTANTE: Inclui a conexão com o banco para poder usar o INSERT e SELECT
include('../config/conexao.php'); 

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
    
    $id_pedido_sprint = 1; // ID fixo simulado para a entrega da Sprint

    // Garante que o Pedido 1 existe na tabela 'pedido' para não dar erro de Chave Estrangeira (FK)
    $verificar_pedido = $conexao->query("SELECT id_pedido FROM pedido WHERE id_pedido = $id_pedido_sprint");
    if ($verificar_pedido->num_rows == 0) {
        $conexao->query("INSERT INTO pedido (id_pedido, dt_pedido, vl_total, st_pedido) VALUES ($id_pedido_sprint, NOW(), 0.00, 'Em andamento')");
    }

    // BUSCA O PREÇO REAL DO PRODUTO NO BANCO DE DADOS
    $busca_produto = $conexao->query("SELECT vl_produto FROM produto WHERE id_produto = $id_produto");
    $dados_produto = $busca_produto->fetch_assoc();
    $preco_real = $dados_produto['vl_produto']; // Captura o valor real (ex: 79.90, 249.90)

    // Captura a quantidade atualizada que está na sessão
    $qt_produto = $_SESSION['carrinho'][$id_produto];

    // Verifica se esse produto já foi inserido para esse pedido no banco
    $verificar_item = $conexao->query("SELECT id_item FROM itempedido WHERE id_pedido = $id_pedido_sprint AND id_produto = $id_produto");

    if ($verificar_item->num_rows > 0) {
        // Se o produto já existia, atualiza a quantidade
        $sql_nn = "UPDATE itempedido SET qt_produto = $qt_produto WHERE id_pedido = $id_pedido_sprint AND id_produto = $id_produto";
    } else {
        // Se é a primeira vez, faz o INSERT salvando o PREÇO REAL encontrado
        $sql_nn = "INSERT INTO itempedido (id_pedido, id_produto, qt_produto, vl_unitario) 
                   VALUES ($id_pedido_sprint, $id_produto, 1, $preco_real)";
    }

    // Executa a query no MySQL
    $conexao->query($sql_nn);
    
    // =========================================================================
}

// Faz a página atualizar e voltar exatamente para onde o cliente estava antes
if (isset($_SERVER['HTTP_REFERER'])) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    header("Location: colecoes.php");
}
exit;
?>
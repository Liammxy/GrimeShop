<?php
ob_start();
session_start();
error_reporting(0);
ini_set('display_errors', 0);

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ob_clean();
    echo json_encode(['status' => false, 'mensagem' => 'Método inválido.']);
    exit;
}

try {
    require_once '../config/conexao.php';

    // Captura os dados enviados pelo FormData do modal no carrinho.php
    $nome        = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $cpf         = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
    $telefone    = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
    $cep         = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_SPECIAL_CHARS);
    $endereco    = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_SPECIAL_CHARS);
    $complemento = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($nome) || empty($cpf) || empty($telefone) || empty($cep) || empty($endereco)) {
        ob_clean();
        echo json_encode(['status' => false, 'mensagem' => 'Preencha todos os campos obrigatórios de entrega.']);
        exit;
    }

    $carrinho = $_SESSION['carrinho'] ?? [];
    if (empty($carrinho)) {
        ob_clean();
        echo json_encode(['status' => false, 'mensagem' => 'Seu carrinho está vazio.']);
        exit;
    }

    $conexao->begin_transaction();
    $erros = [];
    $itensDetalhes = [];
    $valorTotalPedido = 0;

    // Valida estoque e calcula o valor total do pedido com base na tabela produto
    foreach ($carrinho as $id_produto => $quantidade) {
        $id = intval($id_produto);
        $qtdComprada = intval($quantidade);

        if ($id > 0 && $qtdComprada > 0) {
            $stmtProd = $conexao->prepare("SELECT id_produto, qt_estoque, vl_produto FROM produto WHERE id_produto = ?");
            $stmtProd->bind_param("i", $id);
            $stmtProd->execute();
            $resProd = $stmtProd->get_result();

            if ($rowProd = $resProd->fetch_assoc()) {
                if (intval($rowProd['qt_estoque']) >= $qtdComprada) {
                    $precoUnitario = floatval($rowProd['vl_produto']);
                    $valorTotalPedido += ($precoUnitario * $qtdComprada);
                    
                    $itensDetalhes[] = [
                        'id_produto' => $id,
                        'quantidade' => $qtdComprada,
                        'vl_unitario' => $precoUnitario
                    ];
                } else {
                    $erros[] = "Produto '{$rowProd['nm_produto']}' sem estoque suficiente.";
                }
            } else {
                $erros[] = "Produto ID {$id} não encontrado.";
            }
        }
    }

    if (count($erros) > 0) {
        $conexao->rollback();
        ob_clean();
        echo json_encode(['status' => false, 'mensagem' => implode("\n", $erros)]);
        exit;
    }

    // Utiliza um id_pessoa válido existente no banco (ex: 1) para satisfazer a chave estrangeira da tabela pedido
    $idPessoaPadrao = 1;
    $statusPedido = "Concluído";

    // 1. Insere o pedido principal preenchendo obrigatoriamente id_pessoa, dt_pedido, vl_total e st_pedido
    $sqlPedido = "INSERT INTO pedido (id_pessoa, dt_pedido, vl_total, st_pedido) VALUES (?, NOW(), ?, ?)";
    $stmtPedido = $conexao->prepare($sqlPedido);
    $stmtPedido->bind_param("ids", $idPessoaPadrao, $valorTotalPedido, $statusPedido);
    
    if (!$stmtPedido->execute()) {
        throw new Exception("Erro ao registrar o pedido no banco: " . $stmtPedido->error);
    }
    $idPedidoGerado = $conexao->insert_id;

    // 2. Registra os itens na tabela itempedido e desconta o estoque de cada produto
    foreach ($itensDetalhes as $item) {
        $sqlBaixa = "UPDATE produto SET qt_estoque = qt_estoque - ? WHERE id_produto = ?";
        $stmtBaixa = $conexao->prepare($sqlBaixa);
        $stmtBaixa->bind_param("ii", $item['quantidade'], $item['id_produto']);
        $stmtBaixa->execute();

        $sqlItem = "INSERT INTO itempedido (id_pedido, id_produto, qt_produto, vl_unitario) VALUES (?, ?, ?, ?)";
        $stmtItem = $conexao->prepare($sqlItem);
        $stmtItem->bind_param("iiid", $idPedidoGerado, $item['id_produto'], $item['quantidade'], $item['vl_unitario']);
        $stmtItem->execute();
    }

    // Confirma todas as operações no banco de dados
    $conexao->commit();
    
    // Limpa o carrinho da sessão
    unset($_SESSION['carrinho']);

    ob_clean();
    echo json_encode([
        'status' => true, 
        'mensagem' => 'COMPRA FINALIZADA COM SUCESSO! Pedido processado.'
    ]);

} catch (Exception $e) {
    if (isset($conexao) && $conexao->connect_errno === 0) {
        $conexao->rollback();
    }
    ob_clean();
    echo json_encode(['status' => false, 'mensagem' => 'Erro interno: ' . $e->getMessage()]);
}
?>
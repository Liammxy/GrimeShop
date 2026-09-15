<?php
ob_start();
error_reporting(0);
ini_set('display_errors', 0);

header('Content-Type: application/json; charset=utf-8');

try {
    require_once '../config/conexao.php';

    $dados = json_decode(file_get_contents('php://input'), true);
    $id = !empty($dados['id_pedido']) ? intval($dados['id_pedido']) : null;

    if (!$id) {
        ob_clean();
        echo json_encode(['status' => false, 'mensagem' => 'ID do pedido não foi informado.']);
        exit;
    }

    // Exclusão lógica: mantém o histórico do pedido, mas marca como Cancelado
    // (mesmo padrão de st_produto/st_categoria usado no resto do sistema).
    $sql = "UPDATE pedido SET st_pedido = 'Cancelado' WHERE id_pedido = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        ob_clean();
        echo json_encode(['status' => true, 'mensagem' => 'Pedido cancelado com sucesso!']);
    } else {
        ob_clean();
        echo json_encode(['status' => false, 'mensagem' => 'Erro ao cancelar: ' . $stmt->error]);
    }

} catch (Exception $e) {
    ob_clean();
    echo json_encode(['status' => false, 'mensagem' => 'Erro interno: ' . $e->getMessage()]);
}

<?php
ob_start();
error_reporting(0);
ini_set('display_errors', 0);

header('Content-Type: application/json; charset=utf-8');

$STATUS_VALIDOS = ['Processando', 'Pago', 'Enviado', 'Entregue', 'Cancelado'];

try {
    require_once '../config/conexao.php';

    $dados = json_decode(file_get_contents('php://input'), true);

    $id = !empty($dados['id_pedido']) ? intval($dados['id_pedido']) : null;
    $novoStatus = !empty($dados['st_pedido']) ? trim($dados['st_pedido']) : null;

    if (!$id) {
        ob_clean();
        echo json_encode(['status' => false, 'mensagem' => 'ID do pedido não foi informado.']);
        exit;
    }

    if (!$novoStatus || !in_array($novoStatus, $STATUS_VALIDOS, true)) {
        ob_clean();
        echo json_encode(['status' => false, 'mensagem' => 'Status inválido.']);
        exit;
    }

    $sql = "UPDATE pedido SET st_pedido = ? WHERE id_pedido = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("si", $novoStatus, $id);

    if ($stmt->execute()) {
        ob_clean();
        echo json_encode(['status' => true, 'mensagem' => 'Status do pedido atualizado com sucesso!']);
    } else {
        ob_clean();
        echo json_encode(['status' => false, 'mensagem' => 'Erro ao atualizar banco: ' . $stmt->error]);
    }

} catch (Exception $e) {
    ob_clean();
    echo json_encode(['status' => false, 'mensagem' => 'Erro interno: ' . $e->getMessage()]);
}

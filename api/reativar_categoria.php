<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../config/conexao.php';

$dados = json_decode(file_get_contents("php://input"), true);
$id = $dados['id_categoria'] ?? null;

if ($id) {
    $stmt = $conexao->prepare("UPDATE categoria SET st_categoria = 'ativo' WHERE id_categoria = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => true, 'mensagem' => 'Categoria reativada com sucesso!'], JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(['status' => false, 'mensagem' => 'Erro ao reativar: ' . $conexao->error], JSON_UNESCAPED_UNICODE);
    }
} else {
    echo json_encode(['status' => false, 'mensagem' => 'ID inválido.'], JSON_UNESCAPED_UNICODE);
}
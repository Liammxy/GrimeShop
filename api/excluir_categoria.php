<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../config/conexao.php';

$dados = json_decode(file_get_contents("php://input"), true);
$id = $dados['id_categoria'] ?? null;

if ($id) {
    // Altera o status para inativo mantendo os dados salvos no banco
    $stmt = $conexao->prepare("UPDATE categoria SET st_categoria = 'inativo' WHERE id_categoria = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => true, 'mensagem' => 'Categoria desativada com sucesso!'], JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(['status' => false, 'mensagem' => 'Erro ao desativar: ' . $conexao->error], JSON_UNESCAPED_UNICODE);
    }
} else {
    echo json_encode(['status' => false, 'mensagem' => 'ID inválido.'], JSON_UNESCAPED_UNICODE);
}
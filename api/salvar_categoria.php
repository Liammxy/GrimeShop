<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../config/conexao.php';

$dados = json_decode(file_get_contents("php://input"), true);

$id = $dados['id_categoria'] ?? null;
$nome = $dados['nm_categoria'] ?? '';
$badge = $dados['ds_badge'] ?? '';
$status = $dados['st_categoria'] ?? 'ativo';

if (!empty($nome)) {
    if ($id) {
        // EDÇÃO
        $stmt = $conexao->prepare("UPDATE categoria SET nm_categoria = ?, ds_badge = ?, st_categoria = ? WHERE id_categoria = ?");
        $stmt->bind_param("sssi", $nome, $badge, $status, $id);
        $mensagem = "Categoria atualizada com sucesso!";
    } else {
        // INSERÇÃO
        $stmt = $conexao->prepare("INSERT INTO categoria (nm_categoria, ds_badge, st_categoria) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome, $badge, $status);
        $mensagem = "Categoria cadastrada com sucesso!";
    }

    if ($stmt->execute()) {
        echo json_encode(['status' => true, 'mensagem' => $mensagem], JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(['status' => false, 'mensagem' => 'Erro no banco: ' . $conexao->error], JSON_UNESCAPED_UNICODE);
    }
} else {
    echo json_encode(['status' => false, 'mensagem' => 'O nome da categoria é obrigatório.'], JSON_UNESCAPED_UNICODE);
}
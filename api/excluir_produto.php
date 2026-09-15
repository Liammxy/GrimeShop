<?php
ob_start();
error_reporting(0);
ini_set('display_errors', 0);

header('Content-Type: application/json; charset=utf-8');

try {
    $path_conexao = __DIR__ . '/../config/conexao.php';
    if (!file_exists($path_conexao)) {
        ob_clean();
        echo json_encode(['status' => false, 'mensagem' => 'Arquivo de conexão não encontrado.']);
        exit;
    }
    require_once $path_conexao;

    // Recebe o ID vindo da requisição em JSON (fetch do dashboard.js)
    $dados = json_decode(file_get_contents('php://input'), true);
    $id = !empty($dados['id_produto']) ? intval($dados['id_produto']) : null;

    if (!$id) {
        ob_clean();
        echo json_encode(['status' => false, 'mensagem' => 'ID do produto não foi informado.']);
        exit;
    }

    // Altera o status do produto para 'inativo'
    $sql = "UPDATE produto SET st_produto = 'inativo' WHERE id_produto = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        ob_clean();
        echo json_encode(['status' => true, 'mensagem' => 'Produto desativado com sucesso!']);
    } else {
        ob_clean();
        echo json_encode(['status' => false, 'mensagem' => 'Erro ao atualizar banco: ' . $stmt->error]);
    }

} catch (Exception $e) {
    ob_clean();
    echo json_encode(['status' => false, 'mensagem' => 'Erro interno: ' . $e->getMessage()]);
}
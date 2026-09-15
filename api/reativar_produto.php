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

    $json = file_get_contents("php://input");
    $dados = json_decode($json, true);

    $id = !empty($dados['id_produto']) ? intval($dados['id_produto']) : null;

    if (!$id) {
        ob_clean();
        echo json_encode(['status' => false, 'mensagem' => 'ID do produto não informado.']);
        exit;
    }

    $sql = "UPDATE produto SET st_produto = 'ativo' WHERE id_produto = ?";
    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        ob_clean();
        echo json_encode(['status' => false, 'mensagem' => 'Erro SQL: ' . $conexao->error]);
        exit;
    }

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        ob_clean();
        echo json_encode(['status' => true, 'mensagem' => 'Produto reativado com sucesso!']);
    } else {
        ob_clean();
        echo json_encode(['status' => false, 'mensagem' => 'Erro ao reativar: ' . $stmt->error]);
    }

} catch (Exception $e) {
    ob_clean();
    echo json_encode(['status' => false, 'mensagem' => 'Erro interno: ' . $e->getMessage()]);
}
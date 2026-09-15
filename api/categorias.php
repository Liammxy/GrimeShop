<?php
header('Content-Type: application/json; charset=utf-8');

require_once '../config/conexao.php'; 

$sql = "SELECT * FROM categoria";
$resultado = $conexao->query($sql);

if ($resultado) {
    $categorias = $resultado->fetch_all(MYSQLI_ASSOC);
    echo json_encode($categorias, JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode([
        'status' => false,
        'mensagem' => 'Erro ao buscar categorias: ' . $conexao->error
    ], JSON_UNESCAPED_UNICODE);
}
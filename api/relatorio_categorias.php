<?php
header('Content-Type: application/json; charset=utf-8');

try {
    require_once '../config/conexao.php';

    // Chama a Stored Procedure sp_resumo_categoria (definida no 127_0_0_1.sql).
    // Centraliza no banco a agregação por categoria em vez de montar isso no PHP.
    $resultado = $conexao->query("CALL sp_resumo_categoria()");

    $categorias = [];
    if ($resultado) {
        while ($row = $resultado->fetch_assoc()) {
            $categorias[] = $row;
        }
    }

    // Necessário para liberar a conexão após um CALL, pois procedures podem
    // retornar múltiplos result sets.
    while ($conexao->more_results() && $conexao->next_result()) {
        if ($extra = $conexao->store_result()) {
            $extra->free();
        }
    }

    echo json_encode([
        'status' => true,
        'dados' => $categorias
    ]);

} catch (Exception $e) {
    echo json_encode([
        'status' => false,
        'dados' => [],
        'mensagem' => 'Erro interno: ' . $e->getMessage()
    ]);
}

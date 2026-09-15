<?php
header('Content-Type: application/json; charset=utf-8');

try {
    require_once '../config/conexao.php';

    // Lê da view vw_ranking_produtos (127_0_0_1.sql), que usa uma CTE para
    // pré-agregar vendas de itempedido e depois centraliza produto + categoria.
    $sql = "SELECT * FROM vw_ranking_produtos LIMIT 5";
    $resultado = $conexao->query($sql);

    $ranking = [];
    if ($resultado) {
        while ($row = $resultado->fetch_assoc()) {
            $ranking[] = $row;
        }
    }

    echo json_encode([
        'status' => true,
        'dados' => $ranking
    ]);

} catch (Exception $e) {
    echo json_encode([
        'status' => false,
        'dados' => [],
        'mensagem' => 'Erro interno: ' . $e->getMessage()
    ]);
}

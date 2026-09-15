<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

try {
    require_once '../config/conexao.php';

    // Exemplo: Se você tiver uma coluna de valor total na tabela pedido (ex: vl_total ou similar)
    // Caso sua coluna tenha outro nome, ajuste aqui. Ou se preferir contar a quantidade de pedidos, mude para COUNT(*).
    $sql = "SELECT SUM(vl_total) as total_vendas FROM pedido"; 
    $resultado = $conexao->query($sql);
    
    $total = 0;
    if ($resultado && $row = $resultado->fetch_assoc()) {
        $total = floatval($row['total_vendas'] ?? 0);
    }

    echo json_encode([
        'status' => true,
        'total_vendas' => $total
    ]);

} catch (Exception $e) {
    echo json_encode([
        'status' => false,
        'total_vendas' => 0,
        'mensagem' => $e->getMessage()
    ]);
}
<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../config/conexao.php'; // Usa o seu arquivo de conexão existente

try {
    // Consulta SQL unindo itempedido com produto para pegar o nome
    $sql = "SELECT ip.id_item, ip.id_pedido, ip.id_produto, ip.qt_produto, ip.vl_unitario, p.nm_produto 
            FROM itempedido ip
            INNER JOIN produto p ON ip.id_produto = p.id_produto";
    
    $resultado = $conexao->query($sql);
    
    $itens = [];
    if ($resultado) {
        while ($row = $resultado->fetch_assoc()) {
            $itens[] = $row;
        }
    }

    echo json_encode([
        "status" => true,
        "dados" => $itens
    ]);
} catch (Exception $e) {
    echo json_encode([
        "status" => false,
        "dados" => [],
        "mensagem" => $e->getMessage()
    ]);
}
?>
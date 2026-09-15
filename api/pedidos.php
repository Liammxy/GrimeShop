<?php
ob_start();
error_reporting(0);
ini_set('display_errors', 0);

header('Content-Type: application/json; charset=utf-8');

require_once '../config/conexao.php';

$sql = "SELECT
            pe.id_pedido,
            pe.id_pessoa,
            pe.dt_pedido,
            pe.vl_total,
            pe.st_pedido,
            COALESCE(pes.nm_pessoabigint, 'Cliente não identificado') AS nm_cliente,
            (SELECT COUNT(*) FROM itempedido ip WHERE ip.id_pedido = pe.id_pedido) AS qt_itens
        FROM pedido pe
        LEFT JOIN pessoa pes ON pes.id_pessoa = pe.id_pessoa
        ORDER BY pe.dt_pedido DESC";

$resultado = $conexao->query($sql);

if ($resultado) {
    $pedidos = $resultado->fetch_all(MYSQLI_ASSOC);
    echo json_encode($pedidos, JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode([], JSON_UNESCAPED_UNICODE);
}

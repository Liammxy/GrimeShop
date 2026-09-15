<?php
ob_start();
error_reporting(0);
ini_set('display_errors', 0);

header('Content-Type: application/json; charset=utf-8');

require_once '../config/conexao.php';

$sql = "SELECT 
            p.id_produto, 
            p.nm_produto, 
            p.ds_produto,
            p.im_produto, 
            p.id_categoria, 
            p.vl_produto AS vl_preco, 
            p.qt_estoque, 
            COALESCE(p.st_produto, 'ativo') AS st_produto, 
            c.nm_categoria 
        FROM produto p 
        LEFT JOIN categoria c ON p.id_categoria = c.id_categoria 
        ORDER BY p.id_produto DESC";

$resultado = $conexao->query($sql);

if ($resultado) {
    $produtos = $resultado->fetch_all(MYSQLI_ASSOC);
    echo json_encode($produtos, JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode([], JSON_UNESCAPED_UNICODE);
}
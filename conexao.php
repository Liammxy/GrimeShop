<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "grimeshop_db";

// Tenta se conectar ao banco de dados
$conexao = new mysqli($host, $usuario, $senha, $banco);

// Se der erro na conexão, para o site e mostra o erro
if ($conexao->connect_error) {
    die("Falha ao conectar ao banco de dados: " . $conexao->connect_error);
}

// Define o padrão de acentos para não quebrar o texto das roupas
$conexao->set_charset("utf8mb4");
?>
<?php
// config/conexao.php

// Carrega as credenciais seguras do arquivo config.php
if (file_exists(__DIR__ . '/config.php')) {
    include(__DIR__ . '/config.php');
}

// Tenta se conectar ao banco de dados usando as constantes protegidas
$conexao = new mysqli($host, $username, $password, $dbname);

// Se der erro na conexão, para o site e mostra o erro
if ($conexao->connect_error) {
    die("Falha ao conectar ao banco de dados: " . $conexao->connect_error);
}

// Define o padrão de acentos para não quebrar o texto das roupas
$conexao->set_charset("utf8mb4");
?>
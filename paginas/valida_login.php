<?php
session_start();
include('../config/conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT id_usuario, nm_usuario, ds_senha FROM usuario WHERE ds_email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();
        
        // Verifica se a senha bate (suporta tanto texto puro quanto hash seguro)
        if ($senha === $usuario['ds_senha'] || password_verify($senha, $usuario['ds_senha'])) {
            $_SESSION['usuario'] = $usuario['nm_usuario'];
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            
            // Vai direto para a dashboard
            header("Location: dashboard.php");
            exit();
        }
    }

    header("Location: login.php?erro=1");
    exit();
}
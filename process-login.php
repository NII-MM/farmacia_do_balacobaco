<?php
session_start();
require_once 'conexao.php';

// Pega os dados do formulário
$login = $_POST['login'];
$senha = md5($_POST['senha']); // Se seu banco usa MD5

// Busca o usuário no banco
$sql = "SELECT * FROM clientes WHERE login = '$login' AND senha = '$senha'";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    // Login certo - salva na sessão
    $usuario = $resultado->fetch_assoc();
    $_SESSION['cliente_id'] = $usuario['id_cliente'];
    $_SESSION['cliente_nome'] = $usuario['nome_completo'];
    
    // Manda pro sistema
    header('Location: index.php');
} else {
    // Login errado - volta pro login
    header('Location: index.html?erro=1');
}

$conn->close();
?>
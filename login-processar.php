<?php
session_start();
require_once 'conexao.php';

$login = $_POST['login'];
$senha = md5($_POST['senha']);

$sql = "SELECT * FROM clientes WHERE login = '$login' AND senha = '$senha'";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
    $_SESSION['cliente_id'] = $usuario['id_cliente'];
    $_SESSION['cliente_nome'] = $usuario['nome_completo'];
    header('Location: index.php');
} else {
    header('Location: login.html?erro=1');
}

$conn->close();
?>
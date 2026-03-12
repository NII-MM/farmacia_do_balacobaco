<?php
echo "✅ 1 - Arquivo está rodando!<br>";

$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'pharma_sense';

echo "✅ 2 - Variáveis definidas<br>";

$conn = new mysqli($host, $usuario, $senha);

if ($conn->connect_error) {
    die("❌ Erro na conexão: " . $conn->connect_error);
}

echo "✅ 3 - Conectou no MySQL<br>";

$conn->query("CREATE DATABASE IF NOT EXISTS $banco");
$conn->select_db($banco);

echo "✅ 4 - Banco selecionado! Tudo certo! 🚀";
?>
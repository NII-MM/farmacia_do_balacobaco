<?php
$host = 'localhost'; // Seu servidor
$usuario = 'root'; // Seu usuário MySQL
$senha = ''; // Sua senha MySQL
$banco = 'pharma_sense'; // Nome do banco

// 1️⃣ PRIMEIRO: Conecta sem selecionar o banco
$conn = new mysqli($host, $usuario, $senha);

if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}

// 2️⃣ DEPOIS: Cria o banco se não existir
$conn->query("CREATE DATABASE IF NOT EXISTS $banco");

// 3️⃣ POR FIM: Seleciona o banco
$conn->select_db($banco);

echo "✅ Conectado com sucesso!";
?>
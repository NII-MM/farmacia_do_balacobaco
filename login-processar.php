<?php
session_start();
require_once 'conexao.php';


echo "<h2>🔍 DEBUG DO LOGIN</h2>";
echo "<strong>Dados recebidos:</strong><br>";
echo "Login: " . $_POST['login'] . "<br>";
echo "Senha: " . $_POST['senha'] . "<br><br>";

$login = $_POST['login'];
$senha = md5($_POST['senha']);

echo "<strong>Senha criptografada (MD5):</strong> " . $senha . "<br><br>";


$sql = "SELECT * FROM clientes WHERE login = '$login'";
$resultado = $conn->query($sql);

echo "<strong>Procurando usuário:</strong> '$login'<br>";
echo "SQL: " . $sql . "<br>";

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
    echo "✅ Usuário ENCONTRADO!<br>";
    echo "ID: " . $usuario['id_cliente'] . "<br>";
    echo "Nome: " . $usuario['nome_completo'] . "<br>";
    echo "Senha no banco: " . $usuario['senha'] . "<br>";
    echo "Senha que você digitou (MD5): " . $senha . "<br>";
    
    if ($usuario['senha'] === $senha) {
        echo "✅ SENHA CORRETA!<br>";
        
        $_SESSION['cliente_id'] = $usuario['id_cliente'];
        $_SESSION['cliente_nome'] = $usuario['nome_completo'];
        
        echo "✅ SESSÃO CRIADA!<br>";
        echo "Session ID: " . session_id() . "<br>";
        echo "cliente_id: " . $_SESSION['cliente_id'] . "<br>";
        echo "cliente_nome: " . $_SESSION['cliente_nome'] . "<br>";
        echo "<br><a href='index.php'>➡️ Ir para o sistema</a>";
        
    } else {
        echo "❌ SENHA INCORRETA!<br>";
    }
} else {
    echo "❌ Usuário NÃO encontrado!<br>";
}

$conn->close();
?>
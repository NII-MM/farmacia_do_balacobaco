<?php
session_start();
require_once 'conexao.php';


$clientes = $conn->query("SELECT * FROM clientes");
$estoque = $conn->query("SELECT * FROM estoque");
$fornecedores = $conn->query("SELECT * FROM fornecedores");
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharma Sense - Sistema Completo</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="favicon_io (1) 1/favicon.ico">
</head>
<body>
    
    <nav class="navbar">
        <div class="navdiv">
            <div class="logo">
                <img src="favicon_io (1) 1/undefined2.png" alt="Pharmasense Logo" class="logo-img">
                <a href="#">Pharmasense</a>
            </div>
        </div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="produtos.html">Produtos</a></li>
            <li><a href="sobrenos.html">Sobre</a></li>
            <div class="buttons">
                <li style="color: white; margin-right: 15px; list-style: none;">
                    👤 <?php echo isset($_SESSION['cliente_nome']) ? $_SESSION['cliente_nome'] : 'Visitante'; ?>
                </li>
                <?php if(isset($_SESSION['cliente_id'])): ?>
                    <button><a href="logout.php">Sair</a></button>
                <?php else: ?>
                    <button><a href="login.html">Entrar</a></button>
                <?php endif; ?>
            </div>
        </ul>
    </nav>

    <div class="container">
        <h1>🏥 PHARMA SENSE - SISTEMA DE GESTÃO</h1>
        
        
        <div class="stats">
            <div class="stat-item">👥 Clientes: <?php echo $clientes->num_rows; ?></div>
            <div class="stat-item">📦 Produtos: <?php echo $estoque->num_rows; ?></div>
            <div class="stat-item">🏢 Fornecedores: <?php echo $fornecedores->num_rows; ?></div>
        </div>

        <div class="dashboard">
            
            <div class="card">
                <h2>
                    👥 CLIENTES 
                    <span class="badge"><?php echo $clientes->num_rows; ?> registros</span>
                </h2>
                <div class="tabela-container">
                    <?php if ($clientes && $clientes->num_rows > 0): ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome Completo</th>
                                    <th>Login</th>
                                    <th>Telefone</th>
                                    <th>Endereço</th>
                                    <th>Receita</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($c = $clientes->fetch_assoc()): ?>
                                <tr>
                                    <td>#<?php echo $c['id_cliente']; ?></td>
                                    <td><strong><?php echo $c['nome_completo']; ?></strong></td>
                                    <td><?php echo $c['login']; ?></td>
                                    <td><?php echo $c['telefone']; ?></td>
                                    <td><?php echo substr($c['endereco'], 0, 20) . '...'; ?></td>
                                    <td><?php echo $c['receita']; ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="vazio">Nenhum cliente cadastrado</div>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="card">
                <h2>
                    📦 ESTOQUE 
                    <span class="badge"><?php echo $estoque->num_rows; ?> produtos</span>
                </h2>
                <div class="tabela-container">
                    <?php if ($estoque && $estoque->num_rows > 0): ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Produto</th>
                                    <th>Preço</th>
                                    <th>Qtd</th>
                                    <th>Validade</th>
                                    <th>Lote</th>
                                    <th>Fornec</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($p = $estoque->fetch_assoc()): 
                                    $validade = strtotime($p['validade']);
                                    $hoje = strtotime(date('Y-m-d'));
                                    $dias_restantes = ($validade - $hoje) / (60 * 60 * 24);
                                ?>
                                <tr>
                                    <td>#<?php echo $p['id_prod']; ?></td>
                                    <td><strong><?php echo $p['nome_prod']; ?></strong></td>
                                    <td class="preco">R$ <?php echo number_format($p['preco'], 2, ',', '.'); ?></td>
                                    <td><?php echo $p['quantidade']; ?></td>
                                    <td>
                                        <?php echo date('d/m/Y', $validade); ?>
                                        <?php if($dias_restantes <= 30): ?>
                                            <span class="validade-proximo">⚠️ <?php echo round($dias_restantes); ?> dias</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo substr($p['lote'], 0, 8); ?></td>
                                    <td><?php echo $p['fornecedor_id']; ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="vazio">Nenhum produto em estoque</div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card">
                <h2>
                    🏢 FORNECEDORES 
                    <span class="badge"><?php echo $fornecedores->num_rows; ?> registros</span>
                </h2>
                <div class="tabela-container">
                    <?php if ($fornecedores && $fornecedores->num_rows > 0): ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>CNPJ</th>
                                    <th>Telefone</th>
                                    <th>Email</th>
                                    <th>Endereço</th>
                                    <th>Contato</th>
                                    <th>Obs</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($f = $fornecedores->fetch_assoc()): ?>
                                <tr>
                                    <td>#<?php echo $f['id_forn']; ?></td>
                                    <td><?php echo $f['cnpj']; ?></td>
                                    <td><?php echo $f['telefone']; ?></td>
                                    <td><?php echo $f['email']; ?></td>
                                    <td><?php echo substr($f['endereco'], 0, 15) . '...'; ?></td>
                                    <td><?php echo $f['contato_vendedor']; ?></td>
                                    <td><?php echo $f['observacoes'] ? '📝' : '-'; ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="vazio">Nenhum fornecedor cadastrado</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="info-sistema">
            <p>Total de registros: <?php echo ($clientes->num_rows + $estoque->num_rows + $fornecedores->num_rows); ?></p>
        </div>

        <footer>
            <p>© 2026 Pharma Sense - Todos os direitos reservados</p>
        </footer>
    </div>
</body>
</html>
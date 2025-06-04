<?php
session_start();
include 'conexao.php';

// Verifica se o admin está logado
if (!isset($_SESSION['admin_logado'])) {
    header("Location: login.php");
    exit();
}

// Buscar todos os pedidos
$query = "SELECT * FROM pedidos ORDER BY data_pedido DESC";
$stmt = $pdo->prepare($query);
$stmt->execute();
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>ADMINISTRADOR</title>
</head>
<body>

    <nav   nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin_index.php">Painel Adminstradores</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <div class="navbar-nav">
                    <a class="nav-link" href="index.php">Loja Online</a>
                    <a class="nav-link" href="admin_pedidos.php">Pedidos</a>
                    <a class="nav-link" href="adicionar_produto.php">Adicionar produtos</a>
                    <a class="nav-link" href="listar_produtos.php">Listar produtos</a>
                </div>
                <div class="navbar-nav">
                    <a class="nav-link" href="logout.php">Sair</a>
                </div>
            </div>
        </div>
    </div>
    </nav>


    <h1>Lista de Pedidos</h1>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Data</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($pedidos as $pedido): ?>
            <tr>
                <td><?php echo $pedido['id']; ?></td>
                <td><?php echo $pedido['cliente_id']; ?></td>
                <td><?php echo $pedido['data_pedido']; ?></td>
                <td><?php echo $pedido['status']; ?></td>
                <td>
                    <a href="admin_pedido_detalhes.php?id=<?php echo $pedido['id']; ?>">Ver Detalhes</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="listar_produtos.php">Voltar</a>
</body>
</html>

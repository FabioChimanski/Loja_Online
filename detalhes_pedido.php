<?php
session_start();
include 'conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: meus_pedidos.php");
    exit();
}

$pedido_id = $_GET['id'];
$cliente_id = $_SESSION['cliente_id'];

// Busca detalhes do pedido
$query = "SELECT * FROM pedidos WHERE id = :pedido_id AND cliente_id = :cliente_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':pedido_id', $pedido_id);
$stmt->bindParam(':cliente_id', $cliente_id);
$stmt->execute();
$pedido = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pedido) {
    echo "Pedido não encontrado!";
    exit();
}

// Busca os produtos do pedido
$query_produtos = "SELECT pp.*, p.nome, p.preco 
                   FROM pedidos_produtos pp
                   JOIN produtos p ON pp.produto_id = p.id
                   WHERE pp.pedido_id = :pedido_id";
$stmt_produtos = $pdo->prepare($query_produtos);
$stmt_produtos->bindParam(':pedido_id', $pedido_id);
$stmt_produtos->execute();
$produtos = $stmt_produtos->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Pedido</title>
</head>
<body>
    <h2>Detalhes do Pedido #<?= $pedido['id']; ?></h2>
    <a href="meus_pedidos.php">Voltar</a>
    
    <p><strong>Data do Pedido:</strong> <?= date('d/m/Y H:i', strtotime($pedido['data_pedido'])); ?></p>
    <p><strong>Status:</strong> <?= ucfirst($pedido['status']); ?></p>
    <p><strong>Total:</strong> R$ <?= number_format($pedido['total'], 2, ',', '.'); ?></p>

    <h3>Produtos</h3>
    <table border="1">
        <tr>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Preço Unitário</th>
            <th>Subtotal</th>
        </tr>
        <?php foreach ($produtos as $produto): ?>
            <tr>
                <td><?= $produto['nome']; ?></td>
                <td><?= $produto['quantidade']; ?></td>
                <td>R$ <?= number_format($produto['preco'], 2, ',', '.'); ?></td>
                <td>R$ <?= number_format($produto['preco'] * $produto['quantidade'], 2, ',', '.'); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

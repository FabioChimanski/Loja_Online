<?php
session_start();
include 'conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$cliente_id = $_SESSION['cliente_id'];

// Busca os pedidos do cliente
$query = "SELECT * FROM pedidos WHERE cliente_id = :cliente_id ORDER BY data_pedido DESC";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':cliente_id', $cliente_id);
$stmt->execute();
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Pedidos</title>
</head>
<body>
    <h2>Meus Pedidos</h2>
    <a href="index.php">Voltar à Loja</a> | <a href="logout.php">Sair</a>
    
    <?php if (count($pedidos) > 0): ?>
        <table border="1">
            <tr>
                <th>ID do Pedido</th>
                <th>Data</th>
                <th>Valor Total</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($pedidos as $pedido): ?>
                <tr>
                    <td><?= $pedido['id']; ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($pedido['data_pedido'])); ?></td>
                    <td>R$ <?= number_format($pedido['total'], 2, ',', '.'); ?></td>
                    <td><?= ucfirst($pedido['status']); ?></td>
                    <td><a href="detalhes_pedido.php?id=<?= $pedido['id']; ?>">Ver Detalhes</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Você ainda não fez nenhum pedido.</p>
    <?php endif; ?>
</body>
</html>

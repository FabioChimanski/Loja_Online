<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION['admin_logado']) || $_SESSION['admin_logado'] !== true) {
    header("Location: admin_login.php"); // Redireciona para login
    exit();
}

$stmt = $pdo->query("SELECT pedidos.id, usuarios.nome, pedidos.total, pedidos.data_pedido 
                     FROM pedidos 
                     JOIN usuarios ON pedidos.usuario_id = usuarios.id");

$pedidos = $stmt->fetchAll();
?>

<h2>Lista de Pedidos</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Total</th>
        <th>Data</th>
    </tr>
    <?php foreach ($pedidos as $pedido) : ?>
        <tr>
            <td><?= $pedido['id']; ?></td>
            <td><?= $pedido['nome']; ?></td>
            <td>R$ <?= number_format($pedido['total'], 2, ',', '.'); ?></td>
            <td><?= $pedido['data_pedido']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

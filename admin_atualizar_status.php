<?php
session_start();
include 'conexao.php';

// Verifica se o admin está logado
if (!isset($_SESSION['admin_logado'])) {
    header("Location: login.php");
    exit();
}

// Verifica se o formulário foi enviado corretamente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pedido_id'], $_POST['status'])) {
    $pedido_id = $_POST['pedido_id'];
    $status = $_POST['status'];

    // Atualiza o status do pedido
    $query = "UPDATE pedidos SET status = :status WHERE id = :pedido_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':status' => $status, ':pedido_id' => $pedido_id]);

    echo "Status do pedido atualizado com sucesso!";
    header("refresh:2; url=admin_pedidos.php"); // Redireciona após 2 segundos
    exit();
} else {
    echo "Erro ao processar a atualização.";
}
?>

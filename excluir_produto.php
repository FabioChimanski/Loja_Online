<?php
session_start();
include 'conexao.php';

// Verifica se o admin está logado
if (!isset($_SESSION['admin_logado'])) {
    header("Location: login.php");
    exit();
}

// Verificar se foi passado um ID pela URL
if (!isset($_GET['id'])) {
    echo "Produto não encontrado.";
    exit();
}

$id = $_GET['id'];

// Deletar o produto do banco
$sql = "DELETE FROM produtos WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);

echo "Produto excluído com sucesso!";
header("Location: listar_produtos.php");
exit();
?>

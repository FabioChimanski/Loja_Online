<?php
session_start(); // Inicia a sessão

// Verifica se o admin está logado
if (!isset($_SESSION['admin_logado'])) {
    exit();
}
include 'conexao.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>ADM Inicio</title>
</head>
<body>
    
<nav class="navbar navbar-expand-lg bg-body-tertiary">
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

    <div class="container text-center">
        <div class="row">
            <h1>Bem-vindo, <?= $_SESSION['usuario_nome']; ?>!</h1>
    </div>

</body>
</html>
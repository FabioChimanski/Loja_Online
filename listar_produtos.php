<?php
session_start(); // Inicia a sessão

// Verifica se o admin está logado
if (!isset($_SESSION['admin_logado'])) {
    exit();
}
include 'conexao.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

    </style>
    <title>Lista produtos</title>
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


    <br>
<!--<div class="container-md d-flex justify-content-center align-items-center vh-100 text-center">-->

        <div class="row">
            <h3>Produtos Cadastrados</h3>
            
        </div>
        <br>
        <div class="row">
            <table class="table">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Imagem</th>
                    <th scope="col">Ações</th>
                </tr>
                <?php
                $stmt = $pdo->query("SELECT * FROM produtos ORDER BY id DESC");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>{$row['nome']}</td>";
                    echo "<td>{$row['descricao']}</td>";
                    echo "<td>R$ {$row['preco']}</td>";
                    echo "<td><img src='uploads/{$row['imagem']}' width='50'></td>";
                    echo "<td>
                            <a href='editar_produto.php?id={$row['id']}'>Editar</a> |
                            <a href='excluir_produto.php?id={$row['id']}' onclick='return confirm(\"Tem certeza que deseja excluir?\")'>Excluir</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
        <br>
    </div>
</body>
</html>
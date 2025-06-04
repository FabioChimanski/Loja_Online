<?php 

session_start();
include 'conexao.php';

// Verifica se o admin está logado
if (!isset($_SESSION['admin_logado'])) {
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="" href="/favicon.png"/>
    <link rel="shortcut icon" type="image/ico" href="img/FC.ico"/>
    <title>Adicionar produtos</title>
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

    <div class="d-flex justify-content-center">
        <h1 >Adicionar produtos</h1>
    </div>
    <br><br>
    <div class="d-flex justify-content-center">
        <br><br>
        
        <form action="salvar_produtos.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nome: </label>
                <input class="form-control" type="text" name="nome" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Descrição: </label>
                <input class="form-control" type="text" name="descricao" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Preço: </label>
                <input class="form-control" type="number" step="0.01" name="preco" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Imagem: </label>
                <input class="form-control" type="file" name="imagem" >
            </div>
            <div class="d-flex justify-content-center" >
                <button class="btn btn-success" type="submit">Cadastrar</button>
                <a class="btn btn-secondary" href="admin_pedidos.php ">Voltar inicio</a>
            </div>
        </form>
    </div>
</body>
</html>
 
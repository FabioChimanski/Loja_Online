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

// Buscar os dados do produto
$sql = "SELECT * FROM produtos WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

// Se o produto não for encontrado
if (!$produto) {
    echo "Produto não encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Produto</title>
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


    <div class="container-md">
        <div class="d-flex justify-content-center">
        
                <h2>Editar Produto</h2>
        </div>
            <br>
        <div class="d-flex justify-content-center">
                <form action="atualizar_produto.php" method="POST" enctype="multipart/form-data">
                    <div>
                        <input class="form-control" type="hidden" name="id" value="<?= $produto['id']; ?>">
                    </div>
                    <div>
                        <label class="form-label">Nome:</label>
                        <input class="form-control" type="text" name="nome" value="<?= $produto['nome']; ?>" required>
                    </div>
                    <div>
                        <label class="form-label">Descrição:</label>
                        <textarea class="form-control" name="descricao" required><?= $produto['descricao']; ?></textarea>
                    </div>
                    <div>
                        <label class="form-label">Preço:</label>
                        <input class="form-control" type="text" name="preco" value="<?= $produto['preco']; ?>" required>
                    </div>
                    <div>
                        <label class="form-label">Imagem Atual:</label><br>
                        <img src="uploads/<?= $produto['imagem']; ?>" width="100"><br><br>
                    </div>
                    <div>
                        <label class="form-label">Nova Imagem (opcional):</label>
                        <input class="form-control" type="file" name="imagem"><br><br>
                    </div>
                    <div><button class="btn btn-success" type="submit">Atualizar</button></div>
                </form>
        </div>
    </div>
</body>
</html>

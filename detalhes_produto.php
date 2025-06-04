<?php
session_start();
include 'conexao.php';

// Verifica se o ID do produto foi passado na URL
if (!isset($_GET['id'])) {
    echo "Produto não encontrado!";
    exit();
}

$id = $_GET['id'];

// Busca as informações do produto no banco de dados
$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id");
$stmt->execute([':id' => $id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    echo "Produto não encontrado!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $produto['nome']; ?> - Detalhes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Minha Loja</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="carrinho.php">Carrinho</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container mt-5">
        <div class="row">

            <div class="col-md-6">
                <h2><?= $produto['nome']; ?></h2>
                <p><?= $produto['descricao']; ?></p>
                <h4>Preço: R$ <span id="preco"><?= number_format($produto['preco'], 2, ',', '.'); ?></span></h4>

                <label for="quantidade">Quantidade:</label>
                <input type="number" id="quantidade" value="1" min="1" class="form-control w-25" onchange="atualizarPreco()">

                <h4>Total: R$ <span id="total"><?= number_format($produto['preco'], 2, ',', '.'); ?></span></h4>

                <!-- Link para adicionar ao carrinho -->
                <a id="adicionarCarrinho" href="carrinho.php?id=<?= $produto['id']; ?>&quantidade=1" class="btn btn-success mt-3">Adicionar ao Carrinho</a>
                
                <a href="index.php" class="btn btn-secondary mt-3">Voltar</a>
            </div>
            <div class="col-md-6">
                <img src="uploads/<?= $produto['imagem']; ?>" class="img-fluid" alt="<?= $produto['nome']; ?>"style="width:480px; height:auto;">
            </div>
        </div>
    </div>

    <script>
        function atualizarPreco() {
            let precoUnitario = <?= $produto['preco']; ?>;
            let quantidade = document.getElementById("quantidade").value;
            let total = precoUnitario * quantidade;
            document.getElementById("total").innerText = total.toFixed(2).replace('.', ',');

            // Atualiza o link do botão "Adicionar ao Carrinho" com a nova quantidade
            let link = document.getElementById("adicionarCarrinho");
            link.href = `carrinho.php?id=<?= $produto['id']; ?>&quantidade=${quantidade}`;
        }
    </script>
</body>
</html>

<?php
session_start();

// Inicializa o carrinho caso ainda não exista
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Verifica se um produto foi adicionado via GET
if (isset($_GET['id']) && isset($_GET['quantidade'])) {
    $id = $_GET['id'];
    $quantidade = intval($_GET['quantidade']);

    // Se a quantidade for menor que 1, define como 1
    if ($quantidade < 1) {
        $quantidade = 1;
    }

    // Adiciona ou atualiza a quantidade no carrinho
    if (isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id] += $quantidade; // Soma a quantidade se já existir
    } else {
        $_SESSION['carrinho'][$id] = $quantidade; // Adiciona um novo produto
    }
}

// Conexão com o banco
include 'conexao.php';

// Buscar os produtos adicionados ao carrinho
$produtosCarrinho = [];
$totalCarrinho = 0;

if (!empty($_SESSION['carrinho'])) {
    $ids = implode(',', array_keys($_SESSION['carrinho']));
    $stmt = $pdo->query("SELECT * FROM produtos WHERE id IN ($ids)");
    $produtosCarrinho = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Carrinho</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
<div class="d-flex flex-column min-vh-100"> <!-- Adiciona flex para empurrar o footer -->
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg" style="background-color: #2E86AB;"> <!-- Azul surf -->
        <div class="container">
            <!-- Logo à esquerda -->
            <a class="navbar-brand fw-bold text-white" href="index.php">Minha Loja</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <!-- Itens centralizados -->
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link text-white" href="index.php">Início</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="painel_cliente.php">Meus Pedidos</a></li>
                </ul>
            </div>

            <!-- Botão sair à direita -->
            <div class="d-flex">
                <?php
                    if (isset($_SESSION['admin_logado']) || isset($_SESSION['cliente_logado'])) {
                        echo "<a class='btn btn-warning text-dark px-3' href='logout.php'>Sair</a>";
                    }
                ?>
            </div>
        </div>
    </nav>
        
        <div class="container mt-4">
            <h2>Meu Carrinho</h2>

            <?php if (empty($produtosCarrinho)): ?>
                <p>Seu carrinho está vazio!</p>
                <a href="index.php" class="btn btn-primary">Continuar Comprando</a>
            <?php else: ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Total</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produtosCarrinho as $produto): 
                            $id = $produto['id'];
                            $quantidade = $_SESSION['carrinho'][$id];
                            $subtotal = $produto['preco'] * $quantidade;
                            $totalCarrinho += $subtotal;
                        ?>
                            <tr>
                                <td><?= $produto['nome']; ?></td>
                                <td>R$ <?= number_format($produto['preco'], 2, ',', '.'); ?></td>
                                <td><?= $quantidade; ?></td>
                                <td>R$ <?= number_format($subtotal, 2, ',', '.'); ?></td>
                                <td>
                                    <a href="remover_carrinho.php?id=<?= $id; ?>" class="btn btn-danger btn-sm">Remover</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <h4>Total: R$ <?= number_format($totalCarrinho, 2, ',', '.'); ?></h4>
                <a href="index.php" class="btn btn-primary">Continuar Comprando</a>
                <a href="finalizar.php" class="btn btn-success">Finalizar Compra</a>
            <?php endif; ?>
        </div>
        </div> <!-- Fecha div d-flex flex-column min-vh-100 -->
    <?php include 'footer.php'; ?>
</body>
</html>

</body>
</html>

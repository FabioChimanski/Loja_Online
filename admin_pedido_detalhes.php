<?php
session_start();
include 'conexao.php';

// Verifica se o admin está logado
if (!isset($_SESSION['admin_logado'])) {
    header("Location: login.php");
    exit();
}

// Verifica se o ID do pedido foi passado
if (!isset($_GET['id'])) {
    echo "Pedido inválido!";
    exit();
}

$pedido_id = $_GET['id'];

// Busca os dados do pedido
$query_pedido = "SELECT * FROM pedidos WHERE id = :pedido_id";
$stmt = $pdo->prepare($query_pedido);
$stmt->execute([':pedido_id' => $pedido_id]);
$pedido = $stmt->fetch(PDO::FETCH_ASSOC);

// Se não encontrar o pedido
if (!$pedido) {
    echo "Pedido não encontrado!";
    exit();
}

// Busca os produtos do pedido
$query_produtos = "SELECT pp.*, p.nome, p.preco 
                   FROM pedidos_produtos pp
                   JOIN produtos p ON pp.produto_id = p.id
                   WHERE pp.pedido_id = :pedido_id";
$stmt = $pdo->prepare($query_produtos);
$stmt->execute([':pedido_id' => $pedido_id]);
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Detalhes do Pedido</title>
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

    <h1>Detalhes do Pedido #<?php echo $pedido['id']; ?></h1>
    <p><strong>Cliente:</strong> <?php echo $pedido['cliente_id']; ?></p>
    <p><strong>Data do Pedido:</strong> <?php echo $pedido['data_pedido']; ?></p>
    <p><strong>Status:</strong> <?php echo $pedido['status']; ?></p>

    <h2>Produtos do Pedido:</h2>
    <table class="table">
        <tr>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Preço Unitário</th>
            <th>Total</th>
        </tr>
        <?php 
        $total_pedido = 0;
        foreach ($produtos as $produto): 
            $subtotal = $produto['quantidade'] * $produto['preco'];
            $total_pedido += $subtotal;
        ?>
            <tr>
                <td><?php echo $produto['nome']; ?></td>
                <td><?php echo $produto['quantidade']; ?></td>
                <td>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                <td>R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>Total do Pedido: R$ <?php echo number_format($total_pedido, 2, ',', '.'); ?></h3>

    <h2>Atualizar Status</h2>
    <form method="POST" action="admin_atualizar_status.php">
        <input type="hidden" name="pedido_id" value="<?php echo $pedido['id']; ?>">
        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="Pendente" <?php if ($pedido['status'] == "Pendente") echo "selected"; ?>>Pendente</option>
            <option value="Em Processamento" <?php if ($pedido['status'] == "Em Processamento") echo "selected"; ?>>Em Processamento</option>
            <option value="Enviado" <?php if ($pedido['status'] == "Enviado") echo "selected"; ?>>Enviado</option>
            <option value="Finalizado" <?php if ($pedido['status'] == "Finalizado") echo "selected"; ?>>Finalizado</option>
        </select>
        <button class="btn btn-secondary" type="submit">Atualizar</button>
    </form>

</body>
</html>

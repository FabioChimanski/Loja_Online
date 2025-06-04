<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION['cliente_logado'])) {
    header('Location: login.php');
    exit();
}

$cliente_id = $_SESSION['usuario_id']; // ID do cliente salvo na sessão

// Consulta para obter o pedido atual
$sql_atual = "SELECT * FROM pedidos WHERE cliente_id = :cliente_id AND status IN ('pendente', 'processando') ORDER BY data_pedido DESC LIMIT 1";
$stmt_atual = $pdo->prepare($sql_atual);
$stmt_atual->execute([':cliente_id' => $cliente_id]);
$pedido_atual = $stmt_atual->fetch(PDO::FETCH_ASSOC);

// Consulta para obter pedidos anteriores
$sql_anteriores = "SELECT * FROM pedidos WHERE cliente_id = :cliente_id AND status IN ('enviado', 'entregue') ORDER BY data_pedido DESC";
$stmt_anteriores = $pdo->prepare($sql_anteriores);
$stmt_anteriores->execute([':cliente_id' => $cliente_id]);
$pedidos_anteriores = $stmt_anteriores->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


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
        <h2>Meus Pedidos</h2>
        
        <h4>Pedido Atual</h4>
        <?php if ($pedido_atual): ?>
            <div class="card p-3">
                <p><strong>Data:</strong> <?= $pedido_atual['data_pedido'] ?></p>
                <p><strong>Status:</strong> <?= ucfirst($pedido_atual['status']) ?></p>
                <p><strong>Total:</strong> R$ <?= number_format($pedido_atual['total'], 2, ',', '.') ?></p>
            </div>
        <?php else: ?>
            <p>Nenhum pedido em andamento.</p>
        <?php endif; ?>

        <h4 class="mt-4">Pedidos Anteriores</h4>
        <?php if ($pedidos_anteriores): ?>
            <ul class="list-group">
                <?php foreach ($pedidos_anteriores as $pedido): ?>
                    <li class="list-group-item">
                        <strong>Data:</strong> <?= $pedido['data_pedido'] ?> |
                        <strong>Status:</strong> <?= ucfirst($pedido['status']) ?> |
                        <strong>Total:</strong> R$ <?= number_format($pedido['total'], 2, ',', '.') ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Nenhum pedido anterior encontrado.</p>
        <?php endif; ?>
    </div>

        <!-- Rodapé -->
        <footer class="text-white text-center py-4" style="background-color: #2E86AB;">
        <div class="container">
            <div class="social-icons mt-3">
                <a href="#" class="mx-2"><img src="img/facebook.png" width="40"></a>
                <a href="#" class="mx-2"><img src="img/instagran.png" width="40"></a>
                <a href="#" class="mx-2"><img src="img/twiter.png" width="40"></a>
            </div>
            <br>
            <p>
                <a href="sobre.php" class="text-white mx-2">Sobre</a> |
                <a href="contato.php" class="text-white mx-2">Contato</a> |
                <a href="politica.php" class="text-white mx-2">Política de Privacidade</a>
            </p>
            <p class="mb-1">© <?php echo date('Y'); ?> Minha Loja - Todos os direitos reservados.</p>
        </div>
    </footer>

</body>
</html>

</body>
</html>

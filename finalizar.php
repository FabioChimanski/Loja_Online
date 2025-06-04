
<?php

session_start();
include 'conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['cliente_id'])) {
    echo "Você precisa estar logado para finalizar a compra! <a href='login.php'>Faça login aqui</a>";
    header('Location: login.php');
    exit();
}

// Verifica se o carrinho não está vazio
if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    echo "Carrinho vazio!";
    exit();
}

// Obtém o ID do cliente logado
$cliente_id = $_SESSION['cliente_id']; 

// Calcula o total do pedido
$total = array_sum(array_map(function ($qtd, $id) use ($pdo) {
    $stmt = $pdo->prepare("SELECT preco FROM produtos WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);
    return $produto ? $produto['preco'] * $qtd : 0;
}, $_SESSION['carrinho'], array_keys($_SESSION['carrinho'])));

// Insere o pedido no banco de dados
$query = "INSERT INTO pedidos (cliente_id, total, status) VALUES (:cliente_id, :total, 'Pendente')";
$stmt = $pdo->prepare($query);
$stmt->execute([
    ':cliente_id' => $cliente_id, // Passando o ID do cliente logado
    ':total' => $total
]);

// Obtém o ID do pedido recém-criado
$pedido_id = $pdo->lastInsertId();

// Insere os produtos no pedido
foreach ($_SESSION['carrinho'] as $id => $quantidade) {
    $query = "INSERT INTO pedidos_produtos (pedido_id, produto_id, quantidade) VALUES (:pedido_id, :produto_id, :quantidade)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':pedido_id' => $pedido_id,
        ':produto_id' => $id,
        ':quantidade' => $quantidade
    ]);
}

// Limpa o carrinho após a compra
unset($_SESSION['carrinho']);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    html, body {
        background-color: green;
        height: 100%;
        margin: 0;
        display: flex;
        justify-content: center; /* Centraliza horizontalmente */
        align-items: center; /* Centraliza verticalmente */
        text-align: center; /* Centraliza o texto */
    }
    h1{
        color: white;
        font-size: bold;
    }
    </style>
    <title>Pedido Finalizado</title>
</head>
<body>
    <div class="container">
        <h1>Pedido realizado com sucesso</h1>
        <figure class="figure">
            <img src="img/ok.webp" class="figure-img img-fluid rounded" alt="...">
        </figure>
        <br>
        <a href="index.php" class="btn btn-light">Voltar para a Loja</a>
    </div>

</body>
</html>

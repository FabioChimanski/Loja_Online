<?php

session_start();
include 'conexao.php';

// Verifica se o admin está logado
if (!isset($_SESSION['admin_logado'])) {
    header("Location: login.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];

    // Verificar se uma nova imagem foi enviada
    if (!empty($_FILES['imagem']['name'])) {
        $imagem = $_FILES['imagem']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($imagem);

        move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file);

        // Atualizar com nova imagem
        $sql = "UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco, imagem = :imagem WHERE id = :id";
        $params = [':nome' => $nome, ':descricao' => $descricao, ':preco' => $preco, ':imagem' => $imagem, ':id' => $id];
    } else {
        // Atualizar sem modificar a imagem
        $sql = "UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco WHERE id = :id";
        $params = [':nome' => $nome, ':descricao' => $descricao, ':preco' => $preco, ':id' => $id];
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    echo "Produto atualizado com sucesso!";
    header("Location: listar_produtos.php");
    exit();
}
?>

<?php include 'conexao.php';

session_start();
if (!isset($_SESSION['admin_logado'])) {
    header("Location: login.php");
    exit();
}


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];

    //imagem upload
    $imagem = $_FILES['imagem']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($imagem);

    move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file);

    $sql = "INSERT INTO produtos (nome, descricao, preco, imagem) VALUES (:nome, :descricao, :preco, :imagem)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $nome,
        ':descricao' => $descricao,
        ':preco' => $preco,
        ':imagem' => $imagem
    ]);

    echo"Produto cadastrado com sucesso!";
    header("Location: listar_produtos.php");
}
?>
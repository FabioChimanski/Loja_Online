<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] != 'cliente') {
    header("Location: login.php");
    exit();
}


include 'conexao.php';

// Buscar os dados do usuário
$id = $_SESSION['usuario_id'];
$sql = "SELECT * FROM usuarios WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Perfil do Usuário</title>
</head>
<body>
    <h2>Bem-vindo, <?= $usuario['nome']; ?>!</h2>

    <a href="logout.php">Sair</a>
</body>
</html>

<?php 
    include 'conexao.php';
    //usuario e senha
    $usuario = 'admin';
    $senha = password_hash("12345", PASSWORD_DEFAULT);

    // inserir no banco
    $sql = "INSERT INTO administradores (usuario, senha) VALUES (:usuario, :senha)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':usuario' => $usuario,
        ':senha' => $senha
    ]);
    echo"Administrador cadastrado com sucesso!";
?>
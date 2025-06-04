<?php
session_start();
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Buscar o usuário no banco de dados
    $query = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':email' => $email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário existe e a senha está correta
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id']; 
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['tipo'] = $usuario['tipo'];

        if ($usuario['tipo'] === 'cliente') {
            $_SESSION['cliente_id'] = $usuario['id']; 
            $_SESSION['cliente_logado'] = true;
            header("Location: index.php");
        } else {
            $_SESSION['admin_logado'] = true;
            header("Location: admin_index.php");
        }
        exit();
    } else {
        echo "Usuário ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh; /* Garante altura total da tela */
            display: flex;
            align-items: center; /* Centraliza verticalmente */
            justify-content: center; /* Centraliza horizontalmente */
            background-color: #f8f9fa; /* Cor de fundo clara */
        }

        .login-container {
            width: 400px;
            padding: 30px;
            background: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }
    </style>
    <title>Login</title>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <br>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input class="form-control" type="email" name="email" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Senha:</label>
                <input class="form-control" type="password" name="senha" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Entrar</button>
            <a href="cadastro.php" class="btn btn-secondary w-100 mt-2">Cadastre-se</a>
        </form>
    </div>
</body>
</html>

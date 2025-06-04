<?php
include 'conexao.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    //verificar se o email ja existe
    $verificar = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $verificar->execute(['email' => $email]);

    if($verificar->rowCount() > 0){
        echo "Este e-mail já está cadastrado";
    }else{
        //inserir no banco
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':nome' => $nome, ':email' => $email, ':senha' => $senha]);

        echo"Cadastro realizado com sucesso! <a href='login.php'>Fazer login</a>";
    }

}
?>

<!DOCTYPE html>
<html lang="pt">
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
    <title>Cadastro</title>
</head>
<body>
    <div class="cadastro-container">

        <div>
            <h2>Cadastro de Usuário</h2>
        </div>
    <br>
        <div>
            <form action="cadastro.php" method="POST">
                
                <div class="mb-3">
                    <label class="form-label">Nome:</label>
                    <input class="form-control" type="text" name="nome" required>

                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input class="form-control" type="email" name="email" required>

                <div class="mb-3">
                    <label class="form-label">Senha:</label>
                    <input class="form-control" type="password" name="senha" required>
                </div>

                <div>
                    <button class="btn btn-primary w-100" type="submit">Cadastrar</button>
                </div>

            </form>
        </div>
    </div>
</body>
</html>

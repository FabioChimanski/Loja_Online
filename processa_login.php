<?php 
session_start();
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Buscar usuário no banco de dados
    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario"; // Alterei para a tabela 'usuarios'
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':usuario' => $usuario]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário existe e se a senha está correta
    if ($user && password_verify($senha, $user['senha'])){
        if ($user['tipo'] == 'admin'){  // Verifica se o usuário é admin
            $_SESSION['admin'] = $user['usuario'];
            header('Location: painel_admin.php'); // Redireciona para o painel administrativo
            exit();
        } else { // Caso seja um usuário comum
            $_SESSION['usuario'] = $user['usuario'];
            $_SESSION['usuario_id'] = $user['id']; // Armazena o ID do usuário para futuras consultas
            header('Location: index.php'); // Redireciona para a página principal
            exit();
        } 
    } else {
        echo "Usuário ou senha incorretos.";
    }
}
?>

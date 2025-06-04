<?php
$host = 'localhost';
$dbname = 'loja_online';
$username = 'root';  // Usuário padrão do XAMPP
$password = '';  // Senha padrão do XAMPP (deixe em branco)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conectado com sucesso!";
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>

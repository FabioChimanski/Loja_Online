<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

   <!-- Navbar -->
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Minha Loja</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="carrinho.php">Carrinho</a></li>
                    <li class="nav-item"><a class="nav-link" href="painel_cliente.php">Meus Pedidos</a></li>
                    <?php
                        session_start(); // Verifique se a sessão foi iniciada

                        if (isset($_SESSION['admin_logado']) || isset($_SESSION['cliente_logado'])) {
                            // Se o usuário estiver logado, mostra o link para sair
                            echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"logout.php\">Sair</a></li>";
                        } else {
                            // Se o usuário não estiver logado, mostra o link para login
                            echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"login.php\">Login</a></li>";
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
                    
    <div class="container mt-4">
        <h2 class="text-center mb-4">Todos os Produtos</h2>
        <div class="row">
            <!-- Produtos listados do banco -->
            <?php
            include 'conexao.php';
            $stmt = $pdo->query("SELECT * FROM produtos");
            while ($produto = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='col-md-4 mb-4'>";
                echo "<div class='card'>";
                echo "<img src='uploads/{$produto['imagem']}' class='card-img-top' alt='{$produto['nome']}'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>{$produto['nome']}</h5>";
                echo "<p class='card-text'>R$ {$produto['preco']}</p>";
                echo "<a href='detalhes_produto.php?id={$produto['id']}' class='btn btn-primary'>Ver Detalhes</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </div>

    <!-- Rodapé -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2025 Minha Loja - Todos os direitos reservados</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

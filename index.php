
<?php 
include 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Loja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg" style="background-color: #2E86AB;"> <!-- Azul surf -->
    <div class="container">
        <!-- Logo à esquerda -->
        <a class="navbar-brand fw-bold text-white" href="index.php">Minha Loja</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <!-- Itens centralizados -->
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link text-white" href="index.php">Início</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="carrinho.php">Carrinho</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="painel_cliente.php">Meus Pedidos</a></li>
            </ul>
        </div>

        <!-- Botão sair à direita -->
        <div class="d-flex">
            <?php
                session_start();
                if (isset($_SESSION['admin_logado']) || isset($_SESSION['cliente_logado'])) {
                    echo "<a class='btn btn-warning text-dark px-3' href='logout.php'>Sair</a>";
                }
            ?>
        </div>
    </div>
</nav>



        <!--Carrosel-->
        <div id="carouselExampleIndicators" class="carousel slide" style="height: 850px;">        

    <div class="carousel-indicators" style="height: 850px;">

        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>

    </div>

    <div class="carousel-inner" style="height: 850px;">

        <div class="carousel-item active">
        <img src="img/img111.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="img/img111.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="img/img111.jpg" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>


    <!-- Produtos em destaque -->
    <div class="container mt-5" id="produtos_destaque">
        <h2 id="pro_destaque" class="text-center mb-4">Produtos em Destaque</h2>
        <div class="row">
            <!-- Aqui vão os produtos do banco -->
            <?php
            include 'conexao.php';
            $stmt = $pdo->query("SELECT * FROM produtos LIMIT 4");
            while ($produto = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='col-md-3'>";
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

    <?php include 'footer.php'; ?>


</body>
</html>

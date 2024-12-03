<?php
require_once '../php/conectar.php'; // Arquivo de conexão com o banco de dados

// Obtendo o ID do produto da URL
$id_produto = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Buscando as informações do produto no banco
$sql = "SELECT nomeproduto, descricao, preco, imagem FROM produtos WHERE id_produto = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_produto);
$stmt->execute();
$result = $stmt->get_result();

// Verificando se o produto foi encontrado
$produto = $result->fetch_assoc();

// Buscando as imagens adicionais associadas ao produto
$sqlImagens = "SELECT imagem FROM produto_imagens WHERE id_produto = ?";
$stmtImagens = $conn->prepare($sqlImagens);
$stmtImagens->bind_param("i", $id_produto);
$stmtImagens->execute();
$resultImagens = $stmtImagens->get_result();

$stmt->close();
$stmtImagens->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Produto | Projeto Atlântica</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/descprod.css">
    <style>
       /* Estilos do carrossel */
.carousel-container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 40%; /* O carrossel ocupará 80% da largura da tela */
    margin: auto;
    overflow: hidden; /* Esconde imagens além da área visível */
}

.carousel-images {
    display: flex;  
    width: 400px;
    margin-right: 20%;
    transition: transform 0.5s ease-in-out; /* Transição suave entre as imagens */
    
}

.carousel-images img {
    min-width: 70%;
    position: relative;
    height: auto;
    margin-left: 30%;
}
#main-image {
    height: auto;
    border-radius: 10px;
}




/* Navegação */
.carousel-navigation {
    position: absolute;
    top: 50%;
    width: 100%;
    display: flex;
    justify-content: space-between;
    transform: translateY(-50%);
    z-index: 1;
}

.carousel-navigation button {
    background: rgba(0, 0, 0, 0.5);
    color: white;
    font-size: 2rem;
    border: none;
    padding: 1rem;
    border-radius: 50%;
    cursor: pointer;
    transition: background 0.3s ease;
}

.carousel-navigation button:hover {
    background: rgba(0, 0, 0, 0.8);
}
        h2, p, span {
            text-align: center;
        }
    </style>
</head>
<body>
    <main>
        <?php if ($produto): ?>
            <div id="product-info">
                <!-- Carrossel de imagens -->
                <div class="carousel-container">
                    <div class="carousel-images" id="carousel-images">
                        <!-- Imagem principal -->
                        <img id="main-image" 
                             src="../images/<?php echo htmlspecialchars($produto['imagem'], ENT_QUOTES, 'UTF-8'); ?>" 
                             alt="<?php echo htmlspecialchars($produto['nomeproduto'], ENT_QUOTES, 'UTF-8'); ?>">

                        <!-- Imagens adicionais do produto -->
                        <?php while ($imagem = $resultImagens->fetch_assoc()): ?>
                            <img src="../images/<?php echo htmlspecialchars($imagem['imagem'], ENT_QUOTES, 'UTF-8'); ?>" alt="Imagem adicional do produto">
                        <?php endwhile; ?>
                    </div>

                    <!-- Navegação do carrossel -->
                    <div class="carousel-navigation">
                        <button class="prev" id="prev-btn">&lt;</button>
                        <button class="next" id="next-btn">&gt;</button>
                    </div>
                </div>

                <h2><?php echo htmlspecialchars($produto['nomeproduto'], ENT_QUOTES, 'UTF-8'); ?></h2>
                <p><?php echo htmlspecialchars($produto['descricao'], ENT_QUOTES, 'UTF-8'); ?></p>
                <span>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></span>
            </div>

        <?php else: ?>
            <p>Produto não encontrado.</p>
        <?php endif; ?>

        <div class="qq">
            <a href="../php/produtos.php" class="btn">Voltar</a>
        </div>
    </main>
    
    <footer class="footer">
        <div class="footer-text">
            <p>Copyright &copy; 2024 por Projeto TCC Atlântica | Todos os Direitos Reservados.</p>
        </div>
    </footer>

    <script>
       document.addEventListener("DOMContentLoaded", function() {
    const carouselImages = document.querySelector('.carousel-images');
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');
    
    const totalImages = carouselImages.children.length;
    let currentIndex = 0;

    // Função para atualizar o carrossel
    function updateCarousel() {
        const offset = -currentIndex * 100; // Desloca 100% da largura por vez
        carouselImages.style.transform = `translateX(${offset}%)`;
    }

    // Função para mover para a imagem anterior
    prevButton.addEventListener('click', function() {
        if (currentIndex > 0) {
            currentIndex--;
            updateCarousel();
        } else {
            currentIndex = totalImages - 1; // Volta para a última imagem
            updateCarousel();
        }
    });

    // Função para mover para a imagem seguinte
    nextButton.addEventListener('click', function() {
        if (currentIndex < totalImages - 1) {
            currentIndex++;
            updateCarousel();
        } else {
            currentIndex = 0; // Vai para a primeira imagem
            updateCarousel();
        }
    });
});

    </script>
</body>
</html>

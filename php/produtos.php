<?php
// Inicia a sessão
session_start();
include 'conectar.php';

// Verificando a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consultando os produtos
$sql = "SELECT id_produto, imagem, nomeproduto, preco FROM produtos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Atlântica | TCC</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/produtos.css">
    <script>
        // Definindo a variável de login no JS
        var isLoggedIn = <?php echo isset($_SESSION['email']) ? 'true' : 'false'; ?>;
    </script>
</head>

<body>
    <span class="close" id="close-popup">&times;</span>
    <header class="header">
        <img src="../images/logo atlantica.png" alt="" class="logo">

        <i class='bx bx-menu' id="menu-icon"></i>

        <nav class="navbar">
            <a href="../index.php">Início</a>
            <a href="../html/sobrenos.php">Sobre Nós</a>
            <a href="produtos.php" class="active">Produtos</a>
            <?php
            // Exibe o link de Cadastrar apenas se o usuário não estiver logado
            if (!isset($_SESSION['email'])) {
                echo '<a href="../html/cadastrar.php">Cadastrar</a>';
                echo '<a href="../html/logar.php">Logar</a>';
            }
            ?>
            <a href="../html/contato.php">Contato</a>
           
                <?php
                // Verifica se o usuário está logado
                if (isset($_SESSION['email'])) {
                    // Se estiver logado, mostra o botão de Carrinho com badge e Sair
                    echo '<a href="carrinho.php" ><i class="bx bxs-cart-add"></i><span id="item-count" class="cart-badge">0</span></a>';
                    echo '<a href="pedidos.php">Pedidos</a>';
                    echo '<a href="infouser.php"><i class="bx bxs-user-circle"></i></a>';
                    echo '<a href="confirmlogout.php" class="logout-link">Sair</a>';
                }
                ?>
           
        </nav>
    </header>

    <section class="portfolio" id="portfolio">
        <h2 class="heading">Nossos <span class="span1">Produtos</span></h2>

        <div class="container-produtos">
        <?php
// Verificando se há produtos no banco de dados
if ($result->num_rows > 0) {
    // Exibindo cada produto como um card
    while ($row = $result->fetch_assoc()) {
        // Definindo as variáveis para cada produto
        $id_produto = $row['id_produto'];
        $imagem = $row['imagem'];
        $nomeproduto = $row['nomeproduto']; // Novo campo atualizado
        $preco = $row['preco']; // Mantém o preço como número (sem formatação)

        // Formatação para exibição
        $preco_formatado = number_format($preco, 2, ',', '.');

        echo '
        <div class="card" data-id="' . $id_produto . '" data-name="' . addslashes($nomeproduto) . '" data-price="' . $preco . '">
            <img src="../images/' . $imagem . '" alt="' . htmlspecialchars($nomeproduto, ENT_QUOTES, "UTF-8") . '">
            <div class="secinfos">
                <h1>' . htmlspecialchars($nomeproduto, ENT_QUOTES, "UTF-8") . '</h1>
                <h2>Clique em Saiba Mais...</h2>
                <span>R$ ' . $preco_formatado . '</span>
                <a href="../html/descprod.php?id=' . $id_produto . '"><b>
                    Saiba mais</b>
                </a>
                <button onclick="handleAddToCart(' . $id_produto . ', `' . addslashes($nomeproduto) . '`, ' . $preco . ')">
                    <i class="bx bxs-cart-add cart"></i>
                </button>
            </div>
        </div>';
    }
} else {
    echo "<p>Não há produtos disponíveis no momento.</p>";
}

// Fechando a conexão com o banco de dados
$conn->close();
?>

</div>

    </section>

    <footer class="footer">
        <div class="footer-text">
            <p>Copyright &copy; 2024 por Projeto TCC Atlântica | Todos os Direitos Reservados.</p>
        </div>

        <div class="footer-iconTop">
            <a href="#home"><i class="bx bx-up-arrow-alt"></i></a>
        </div>
    </footer>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="../js/produtos.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/updateCart.js"></script>
</body>

</html>

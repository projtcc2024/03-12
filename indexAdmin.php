<?php
// Iniciar a sessão para verificar o tipo de usuário
session_start();

// Verificar se o usuário está logado e se possui permissão de acesso
if (!isset($_SESSION['tipoUser']) || $_SESSION['tipoUser'] == 2) {
    // Redirecionar para a página de erro se o usuário não estiver logado ou for um usuário comum
    header('Location: php/erro.php');
    exit; // Importante para interromper o código a seguir
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Atlântica | TCC</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/homephpAdmin.css">
</head>

<body>
<span class="close" id="close-popup">&times;</span>

    <header class="header">
        <img src="images/logo atlantica.png" alt="" class="logo">
        <i class='bx bx-menu' id="menu-icon"></i>
        <nav class="navbar">
            <a href="index.php" class="active">Início</a>
            <a href="php/consultaprod.php">Produtos</a>
            <a href="php/consultauser.php">Usuários</a>
            <a href="php/consultapedidos.php">Pedidos</a>
            <a href="php/cadproduto.php"><i class='bx bx-plus'></i></a>
            <a href="php/infouserAdmin.php"><i class="bx bxs-user-circle"></i></a>              <!-- Exibir o botão "Sair" se o usuário estiver logado como administrador -->
              <?php if (isset($_SESSION['tipoUser']) && $_SESSION['tipoUser'] == 1): ?>
                <a href="php/confirmlogoutAdmin.php" class="logout-button">Sair</a>
            <?php endif; ?>
        </nav>
    </header>

    <section class="services" id="services">
    <h2 class="heading">Minhas <span>Especialidades</span></h2>
    
    <div class="services-container">
        <div class="services-box floatupcard">
            <i class='bx bx-hard-hat'></i>
            <h3>Engenharia Mecânica</h3>
            <p>RESISTÊNCIA E SEGURANÇA</p>
            <a href="php/descesp.php?id=1" class="btn">Editar</a>
        </div>

        <div class="services-box floatdowncard">
            <i class='bx bx-palette'></i>
            <h3>Carpintaria</h3>
            <p>ESTÉTICA E QUALIDADE</p>
            <a href="php/descesp.php?id=2" class="btn">Editar</a>
        </div>

        <div class="services-box floatupcard">
            <i class='bx bx-bar-chart-alt'></i>
            <h3>Designer</h3>
            <p>INOVAÇÃO E ELEGÂNCIA</p>
            <a href="php/descesp.php?id=3" class="btn">Editar</a>
        </div>
    </div>
</section>

<section class="portfolio" id="portfolio">
        <h2 class="heading">Nossos <span>Produtos</span></h2>

        <div class="portfolio-container">
            <div class="portfolio-box">
                <img src="images/at8.png" alt="">
                <div class="portfolio-layer">
                    <h4>Cama Luxo</h4>
                    <p>ATLÂNTICA DESIGN</p>
                    <a href="php/produtos.php"><i class="bx bx-link-external"></i></a>
                </div>
            </div>

            <div class="portfolio-box">
                <img src="images/cone1.jpeg" alt="">
                <div class="portfolio-layer">
                    <h4>CAMA CAVERNA</h4>
                    <p>ATLÂNTICA DESIGN</p>
                    <a href="php/produtos.php"><i class="bx bx-link-external"></i></a>
                </div>
            </div>

            <div class="portfolio-box">
                <img src="images/at10.png" alt="">
                <div class="portfolio-layer">
                    <h4>TAMBOURETE</h4>
                    <p>ATLÂNTICA DESIGN</p>
                    <a href="php/produtos.php"><i class="bx bx-link-external"></i></a>
                </div>
            </div>

            <div class="portfolio-box">
                <img src="images/at1.png" alt="">
                <div class="portfolio-layer">
                    <h4>PRATELEIRA PARA GATOS</h4>
                    <p>ATLÂNTICA DESIGN</p>
                    <a href="php/produtos.php"><i class="bx bx-link-external"></i></a>
                </div>
            </div>

            <div class="portfolio-box">
                <img src="images/at7.png" alt="">
                <div class="portfolio-layer">
                    <h4>REDE PET</h4>
                    <p>ATLÂNTICA DESIGN</p>
                    <a href="php/produtos.php"><i class="bx bx-link-external"></i></a>
                </div>
            </div>

            <div class="portfolio-box">
                <img src="images/at12.png" alt="">
                <div class="portfolio-layer">
                    <h4>BERÇO PARA ADULTOS</h4>
                    <p>ATLÂNTICA DESIGN</p>
                    <a href="php/produtos.php"><i class="bx bx-link-external"></i></a>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-text">
            <p>Copyright &copy; 2024 por Projeto TCC Atlântica | Todos os Direitos Reservados.</p>
        </div>
        <div class="footer-iconTop">
            <a href="#services"><i class="bx bx-up-arrow-alt"></i></a>
        </div>
    </footer>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="js/script.js"></script>
</body>

</html>

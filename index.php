<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Atlântica | TCC</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/homephp.css">
</head>

<body>
<?php if (isset($_SESSION['email'])): ?>

<span class="close" id="close-popup">&times;</span>
<?php endif; ?>

<?php if (!isset($_SESSION['email'])): ?>
        <div id="popup" class="popup">
            <div class="popup-content">
                <div class="closebtn">
                    <span class="close" id="close-popup">&times;</span>
                </div>
                <h2 class="titleform">Cadastre-<span>Se</span></h2>

                <form id="form" action="php/salvaruser.php" method="post">
                    <div class="input-box">
                        <input type="text" placeholder="CPF" name="CPF" id="cpf-input" required>
                        <input type="text" placeholder="Nome Completo" name="nome" id="nome-input">
                    </div>

                    <div class="input-box">
                        <input type="email" placeholder="Email" name="email" required>
                        <input type="password" placeholder="Senha" name="senha">
                        <input type="date" placeholder="Data de Nascimento" name="dtnasc" id="dtnasc-input">
                    </div>

                    <button class="btn" type="submit">Cadastrar</button>
                </form>
            </div>
        </div>
    <?php endif; ?>
    <header class="header">
        <img src="images/logo atlantica.png" alt="" class="logo">

        <i class='bx bx-menu' id="menu-icon"></i>

        <nav class="navbar">
            <a href="index.php" class="active">Início</a>
            <a href="html/sobrenos.php">Sobre Nós</a>
            <a href="php/produtos.php">Produtos</a>
            <?php
            // Exibe o link de Cadastrar apenas se o usuário não estiver logado
            if (!isset($_SESSION['email'])) {
                echo '<a href="html/cadastrar.php">Cadastrar</a>';
                echo '<a href="html/logar.php">Logar</a>';
            }
            ?>           
            <a href="html/contato.php">Contato</a>
            
                <?php
                // Verifica se o usuário está logado
                if (isset($_SESSION['email'])) {
                    // Se estiver logado, mostra o botão de Carrinho com badge e Sair
                    echo '<a href="php/carrinho.php" ><i class="bx bxs-cart-add"></i><span id="item-count" class="cart-badge">0</span></a>';
                    echo '<a href="php/pedidos.php">Pedidos</a>';
                    echo '<a href="php/infouser.php"><i class="bx bxs-user-circle"></i></a>';
                    echo '<a href="php/confirmlogout.php" class="logout-link">Sair</a>';
                }
                ?>
           
        </nav>
    </header>

    <section class="home" id="home">
        <div class="home-content">
            <div class="escritas">
                <h3 class="first escrita1">Novos</h3>
                <h1 class="escrita2"><span>Produtos</span></h1>
                <h3 class="escrita3">Para pets<span class="multiple-text"> </span></h3>
            </div>
            <div class="social-media">
                <a href="#" class="floatup"><i class='bx bxl-facebook'></i></a>
                <a href="#" class="floatdown"><i class='bx bxl-twitter'></i></a>
                <a href="https://www.instagram.com/atlanticamoveis_/" class="floatup"><i class='bx bxl-instagram-alt'></i></a>
                <a href="#" class="floatdown"><i class='bx bxl-linkedin'></i></a>
            </div>
            <a href="php/produtos.php" class="btn">Ver Produtos</a>
        </div>

        <div class="home-img">
            <img src="images/imghome.png" alt="Alguma imagem">
        </div>
    </section>

    <section class="about" id="about">
        <div class="about-img">
            <img src="images/chairimg.png" alt="Alguma imagem">
        </div>

        <div class="about-content">
            <h2 class="heading">Sobre os <span>Produtos</span></h2>
            <h3>Artesanais.</h3>
            <p>Nossos produtos são desenvolvidos a mão, com materiais como: Madeira, ferro, alumínio, aço inoxidável...</p>
            <a href="php/produtos.php" class="btn">Saber Mais</a>
        </div>
    </section>

  <section class="services" id="services">
    <h2 class="heading">Minhas <span>Especialidades</span></h2>
    
    <div class="services-container">
        <div class="services-box floatupcard">
            <i class='bx bx-hard-hat'></i>
            <h3>Engenharia Mecânica</h3>
            <p>RESISTÊNCIA E ELEGÂNCIA</p>
            <a href="php/descesp.php?id=1" class="btn">Ler Mais</a>
        </div>

        <div class="services-box floatdowncard">
            <i class='bx bx-palette'></i>
            <h3>Carpintaria</h3>
            <p>ESTÉTICA E QUALIDADE</p>
            <a href="php/descesp.php?id=2" class="btn">Ler Mais</a>
        </div>

        <div class="services-box floatupcard">
            <i class='bx bx-bar-chart-alt'></i>
            <h3>Designer</h3>
            <p>INOVAÇÃO E ELEGÂNCIA</p>
            <a href="php/descesp.php?id=3" class="btn">Ler Mais</a>
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
            <a href="#home"><i class="bx bx-up-arrow-alt"></i></a>
        </div>
    </footer>

    <!-- Script para atualizar o contador de itens no carrinho -->
    <script>
        // Função para atualizar o contador de itens no carrinho com base no localStorage
        function updateCartCount() {
            // Recupera o carrinho do localStorage
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            // Calcula o total de itens no carrinho
            const itemCount = cart.reduce((acc, item) => acc + item.quantity, 0);
            // Atualiza o contador no ícone do carrinho
            document.getElementById('item-count').textContent = itemCount;
        }

        // Chama a função para atualizar o contador ao carregar a página
        document.addEventListener("DOMContentLoaded", updateCartCount);
    </script>

   


    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="js/script.js"></script>
</body>

</html>
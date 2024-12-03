<?php
// Inicia a sessão
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.1/mdb.min.css">
    <link rel="stylesheet" href="../css/contato.css">
</head>
<body>
    <span class="close" id="close-popup">&times;</span>

     <header class="header">
        <img  src="../images/logo atlantica.png" alt="" class="logo">

        <i class='bx bx-menu' id="menu-icon"></i>

        <nav class="navbar">
            <a href="../index.php">Início</a>
            <a href="sobrenos.php">Sobre Nós</a>
            <a href="../php/produtos.php">Produtos</a>
            <?php
        // Exibe o link de Cadastrar apenas se o usuário não estiver logado
            if (!isset($_SESSION['email'])) {
            echo '<a href="cadastrar.php">Cadastrar</a>';
            echo '<a href="logar.php">Logar</a>';
            }
            ?>            
            <a href="contato.php" class="active">Contato</a>
            <?php
            // Verifica se o usuário está logado
            if (isset($_SESSION['email'])) {
                // Se estiver logado, mostra o botão de Carrinho com badge e Sair
                echo '<a href="../php/carrinho.php" ><i class="bx bxs-cart-add"></i><span id="item-count" class="cart-badge">0</span></a>';
                echo '<a href="../php/pedidos.php">Pedidos</a>';
                echo '<a href="../php/infouser.php"><i class="bx bxs-user-circle"></i></a>';
                echo '<a href="../php/confirmlogout.php" class="logout-link">Sair</a>';
            }
            ?>
            

        </nav>
     </header>

     

     <section class="contact" id="contact">        
        <br><br><h2 class="heading">Contate <span>Nos</span></h2>
    <div class="container">
        <div class="socialicons">
            <a href="https://api.whatsapp.com/send/?phone=1193640302&text&type=phone_number&app_absent=0"><i class='bx bxl-whatsapp'></i></a>         
            <a href="https://www.instagram.com/atlanticamoveis_/profilecard/?igsh=NWhhbnNqczM5b2pr"><i class='bx bxl-instagram'></i></a>
            <a href=""><i class='bx bx-envelope'></i></a>       
        </div>
        <div class="complementosociais">
            <a href="https://api.whatsapp.com/send/?phone=1193640302&text&type=phone_number&app_absent=0"><h2>(11)95364-0302</h2></a>
            <a href=""><h2 href="https://www.instagram.com/atlanticamoveis_/profilecard/?igsh=NWhhbnNqczM5b2pr">@atlanticamoveis</h2></a>
            <a href=""><h2>atlantica.design01@gmail.com</h2></a>
        </div>
     </div>
     </section>

     <footer class="footer">
        <div class="footer-text">
            <p>Copyright &copy; 2024 por Projeto TCC atlântica| All Rights Reserved.</p>
        </div>

        <div class="footer-iconTop">
            <a href="#home"><i class="bx bx-up-arrow-alt"></i></a>
        </div>
     </footer>
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
     <script src="../js/script.js"></script>
</body>
</html>
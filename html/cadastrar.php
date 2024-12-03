<?php
session_start();

// Redireciona o usuário para a página inicial se ele já estiver logado
if (isset($_SESSION['email'])) {
    header("Location: ../index.php");
    exit();
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Atlântica | TCC</title>    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.1/mdb.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   <link rel="stylesheet" href="../css/cadastrar.css">
   
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
            <a href="cadastrar.php" class="active">Cadastrar</a>
            <a href="logar.php">Logar</a>
            <a href="contato.php" >Contato</a>
            <div class="carrinho">
            <?php
            // Verifica se o usuário está logado
            if (isset($_SESSION['email'])) {
                // Se estiver logado, mostra o botão de Carrinho com badge e Sair
                echo '<a href="../php/carrinho.php" ><i class="bx bxs-cart-add"></i><span id="item-count" class="cart-badge">0</span></a>';
                echo '<a href="../php/confirmlogout.php" class="logout-link">Sair</a>';
            }
            ?>
            </div>
            </div>
            
        </nav>
     </header>

     

     <section class="contact" id="contact">
        <h2 class="heading">Cadastre-<span>Se</span></h2>
    
        <form id="formcad" action="../php/salvaruser.php" method="post">
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
        
    </section>
    

     <footer class="footer">
        <div class="footer-text">
            <p>Copyright &copy; 2024 por Projeto TCC atlântica| Todos os Direitos Reservados.</p>
        </div>

        <div class="footer-iconTop">
            <a href="#home"><i class="bx bx-up-arrow-alt"></i></a>
        </div>
     </footer>
     <script src="https://unpkg.com/scrollreveal"></script>
     <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
     <script src="../js/script.js"></script>
     <script src="../js/login.js"></script>
</body>
</html>
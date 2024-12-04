<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['email'])) {
    header("Location: carrinhoerro.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Atlântica | TCC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.1/mdb.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/carrinho.css">
</head>

<body>
    <span class="close" id="close-popup">&times;</span>
    <header class="header">
        <img src="../images/logo atlantica.png" alt="Logo Atlântica" class="logo">
        <i class='bx bx-menu' id="menu-icon"></i>
        <nav class="navbar">
            <a href="../index.php">Início</a>
            <a href="../html/sobrenos.php">Sobre Nós</a>
            <a href="produtos.php">Produtos</a>
            <?php
        // Exibe o link de Cadastrar apenas se o usuário não estiver logado
            if (!isset($_SESSION['email'])) {
            echo '<a href="../html/cadastrar.php">Cadastrar/Logar</a>';
            }
            ?>
            <a href="../html/contato.php">Contato</a>
            <?php
            // Verifica se o usuário está logado
            if (isset($_SESSION['email'])) {
                // Se estiver logado, mostra o botão de Carrinho com badge e Sair
                echo '<a href="carrinho.php" class="active"><i class="bx bxs-cart-add"></i><span id="item-count" class="cart-badge">0</span></a>';
                echo '<a href="pedidos.php">Pedidos</a>';
                echo '<a href="infouser.php"><i class="bx bxs-user-circle"></i></a>';
                echo '<a href="confirmlogout.php" class="logout-link">Sair</a>';
            }
            ?>
        </nav>
    </header>
    <main>
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8">
                    <div class="card card-registration" style="border-radius: 15px; background-color: #2a2d36;">
                        <div class="card-body p-5">
                            <h1 class="fw-bold mb-4">Seu Carrinho</h1>
                            <h6 class="mb-4" id="item-count">0 itens</h6>
                            <hr class="my-4">
                            <div id="cart-items" class="cart-container">
                                <!-- ID para manipulação -->
                                <!-- Os itens do carrinho serão gerados dinamicamente aqui -->
                            </div>
                            <hr class="my-4">
                            <div class="pt-5">
                                <h6 class="mb-0"><a href="../index.php" class=""><i
                                            class="fas fa-long-arrow-alt-left me-2"></i>Voltar para o início</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="p-5">
                        <h3 class="fw-bold mb-5">Resumo</h3>
                        <hr class="my-4">
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="text-uppercase">Itens <span id="total-items">0</span></h5>
                            <h5 id="total-price">R$ 0.00</h5>
                        </div>
                        
                        <h5 class="text-uppercase mb-3">Código promocional</h5>
                        <div class="mb-5">
                            <input type="text" id="promo-code" class="form-control" placeholder="Digite seu código" />
                            <button class="btn" onclick="applyPromoCode()">Aplicar</button>
                        </div>
                        <hr class="my-4">
                        <div class="d-flex justify-content-between mb-5">
                            <h5 class="text-uppercase">Preço total</h5>
                            <h5 id="final-price">R$ 0.00</h5>
                        </div>

                        <!-- Formulário para enviar os produtos -->
                        <form action="finalizarpedido.php" method="POST" id="form-finalizar">
                            <!-- Os itens do carrinho serão adicionados aqui dinamicamente -->
                            <div id="hidden-inputs"></div>
                            <button type="submit" class="btn">Finalizar Pedido</button>
                        </form>

                        <script>
                        // Adiciona os itens do carrinho ao formulário antes do envio
                        const form = document.getElementById('form-finalizar');
                        const hiddenInputs = document.getElementById('hidden-inputs');

                        form.addEventListener('submit', function() {
                            hiddenInputs.innerHTML = ''; // Limpa os campos antes de adicioná-los
                            cart.forEach(item => {
                                // Cria um campo oculto para cada item no carrinho
                                const input = document.createElement('input');
                                input.type = 'hidden';
                                input.name = 'produtos[]'; // Nome do campo para array
                                input.value = JSON.stringify(item); // Stringifica o objeto do item
                                hiddenInputs.appendChild(input);
                            });
                        });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </main>
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
    <script src="../js/script.js"></script>
    <script src="../js/carrinho.js"></script>
    <script src="../js/updateCart.js"></script>
</body>

</html>
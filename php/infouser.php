<?php
// Conectar ao banco de dados
include('conectar.php');

// Iniciar a sessão e verificar se o usuário está logado
session_start();
if (!isset($_SESSION['id_usuario'])) {
    // Se não estiver logado, exibe mensagem e redireciona para a página de login
    echo "<p class='error-message'>Você precisa estar logado para acessar esta página.</p>";
    header("Refresh: 2; URL=../index.php"); // Redireciona após 3 segundos
    exit();
}

// Recuperar o ID do usuário da sessão
$id_usuario = $_SESSION['id_usuario'];

// Recuperar dados do usuário do banco
$query = "SELECT * FROM usuario WHERE id_usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

// Se o formulário for enviado para atualizar os dados

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/infouser.css">

</head>
<body>
<header class="header">
    <img src="../images/logo atlantica.png" alt="" class="logo">

    <i class='bx bx-menu' id="menu-icon"></i>

    <nav class="navbar">
        <a href="../index.php">Início</a>
        <a href="../html/sobrenos.php">Sobre Nós</a>
        <a href="produtos.php">Produtos</a>
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
            echo '<a href="carrinho.php"><i class="bx bxs-cart-add"></i><span id="item-count" class="cart-badge">0</span></a>';
            echo '<a href="pedidos.php">Pedidos</a>';
            echo '<a href="infouser.php" class="active"><i class="bx bxs-user-circle"></i></a>';
            echo '<a href="confirmlogout.php" class="logout-link">Sair</a>';
        }
        ?>
    </nav>
</header>

<main>
    <h1>Minhas <span> Informações</h1></span>

    <!-- Exibir a mensagem de erro caso o usuário não esteja logado -->
    <?php if (!isset($_SESSION['id_usuario'])): ?>
        <p class="error-message">Você precisa estar logado para acessar esta página.</p>
    <?php endif; ?>


    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $dtnasc = $_POST['dtnasc'];
        $senha = $_POST['senha'];
    
        // Atualizar os dados no banco
        $query_update = "UPDATE usuario SET nome = ?, email = ?, CPF = ?, dtnasc = ?, senha = ? WHERE id_usuario = ?";
        $stmt_update = $conn->prepare($query_update);
        $stmt_update->bind_param("sssssi", $nome, $email, $cpf, $dtnasc, $senha, $id_usuario);
        $stmt_update->execute();
    
        // Exibir uma mensagem de sucesso
        echo "<div class='message success'>Informações atualizadas com sucesso!</div>";
        header("Refresh: 2; URL=infouser.php"); // Redireciona após 3 segundos
    
    }
    ?>
    <form method="POST" action="infouser.php">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $usuario['nome']; ?>" required>
        </div>

        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?php echo $usuario['email']; ?>" required>
        </div>

        <div class="form-group">
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" value="<?php echo $usuario['CPF']; ?>" required>
        </div>

        <div class="form-group">
            <label for="dtnasc">Data de Nascimento:</label>
            <input type="date" id="dtnasc" name="dtnasc" value="<?php echo $usuario['dtnasc']; ?>" required>
        </div>

        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" value="<?php echo $usuario['senha']; ?>" required>
        </div>

        <button type="submit">Atualizar Informações</button>
        <?php
    // Exibe o botão "Alternar para Admin" apenas para usuários tipo 2
    if (isset($_SESSION['tipoUser']) && $_SESSION['tipoUser'] == 1) {
        echo '<a href="../indexAdmin.php" class="btn">Alternar para Admin</a>';
    }
    ?>
    </form>
    
</main>

<script src="../js/updateCart.js"></script>

</body>
</html>

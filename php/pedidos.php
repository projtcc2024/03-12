<?php
session_start();
include 'conectar.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    die("Erro: Usuário não está logado. Faça login para acessar seus pedidos.");
}
$id_usuario = $_SESSION['id_usuario'];

// Cancela o pedido
if (isset($_GET['cancelar_id'])) {
    $cancelar_id = $_GET['cancelar_id'];

    // Deleta o pedido do banco de dados
    $sql_cancelar = "DELETE FROM pedidos WHERE id_pedido = ? AND id_usuario = ?";
    $stmt_cancelar = $conn->prepare($sql_cancelar);
    $stmt_cancelar->bind_param("ii", $cancelar_id, $id_usuario);
    if ($stmt_cancelar->execute()) {
        echo "<script>alert('Pedido cancelado com sucesso.'); window.location.href='pedidos.php';</script>";
    } else {
        echo "<script>alert('Erro ao cancelar o pedido. Tente novamente.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Pedidos</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/pedidos.css">

</head>
<body>
<span class="close" id="close-popup">&times;</span>

<header class="header">
        <img src="../images/logo atlantica.png" alt="" class="logo">

        <i class='bx bx-menu' id="menu-icon"></i>

        <nav class="navbar">
            <a href="../index.php">Início</a>
            <a href="../html/sobrenos.php">Sobre Nós</a>
            <a href="produtos.php" >Produtos</a>
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
                    echo '<a href="pedidos.php" class="active">Pedidos</a>';
                    echo '<a href="infouser.php"><i class="bx bxs-user-circle"></i></a>';
                    echo '<a href="confirmlogout.php" class="logout-link">Sair</a>';
                }
                ?>
        </nav>
    </header>

    <div class="container">
        <h1>Meus Pedidos</h1>

        <?php
        // Busca os pedidos do usuário no banco de dados
        $sql = "SELECT p.id_pedido, p.id_produto, p.quantidade_produto, p.preco_produto, pr.nomeproduto, pr.imagem 
                FROM pedidos p 
                JOIN produtos pr ON p.id_produto = pr.id_produto 
                WHERE p.id_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Preço Unitário</th>
                        <th>Subtotal</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()):
                        $subtotal = $row['quantidade_produto'] * $row['preco_produto'];
                    ?>
                        <tr>
                            <td><img src="../images/<?php echo $row['imagem']; ?>" alt="Imagem do Produto"></td>
                            <td><?php echo $row['nomeproduto']; ?></td>
                            <td><?php echo $row['quantidade_produto']; ?></td>
                            <td>R$ <?php echo number_format($row['preco_produto'], 2, ',', '.'); ?></td>
                            <td>R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></td>
                            <td>
                                <a href="?cancelar_id=<?php echo $row['id_pedido']; ?>" class="cancelar-btn" onclick="return confirm('Tem certeza que deseja cancelar este pedido?')">Cancelar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-orders">Você ainda não fez nenhum pedido.</p>
        <?php endif; ?>

        <?php $conn->close(); ?>
    </div>
            <script src="../js/script.js"></script>
            <script src="../js/updateCart.js"></script>

</body>
</html>

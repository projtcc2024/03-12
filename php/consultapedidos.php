<?php
include 'conectar.php';
include 'confirmadmin.php';

// Inicializa a variável de mensagem como uma string vazia
$message = '';

// Consulta todos os pedidos
$sql = "
    SELECT 
        pedidos.id_pedido, 
        pedidos.id_usuario, 
        pedidos.id_produto, 
        pedidos.preco_produto, 
        pedidos.quantidade_produto,
        usuario.nome AS nome_usuario,
        produtos.nomeproduto AS nomeproduto
    FROM pedidos
    JOIN usuario ON pedidos.id_usuario = usuario.id_usuario
    JOIN produtos ON pedidos.id_produto = produtos.id_produto
";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Pedidos | Projeto Atlântica</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/consultaprod.css">
</head>

<body>
<span class="close" id="close-popup">&times;</span>

    <header class="header">
        <img src="../images/logo atlantica.png" alt="Logo Atlântica" class="logo">
        <i class='bx bx-menu' id="menu-icon"></i>
        <nav class="navbar">
            <a href="../indexAdmin.php">Início</a>
            <a href="consultaprod.php">Produtos</a>
            <a href="consultauser.php">Usuários</a>
            <a href="consultapedidos.php" class="active">Pedidos</a>
            <a href="cadproduto.php"><i class='bx bx-plus'></i></a>
            <a href="infouserAdmin.php"><i class="bx bxs-user-circle"></i></a>
            <?php if (isset($_SESSION['tipoUser']) && $_SESSION['tipoUser'] == 1): ?>
                <a href="confirmlogoutAdmin.php" class="logout-button">Sair</a>
            <?php endif; ?>
        </nav>
    </header>

    <section class="portfolio" id="portfolio">
        <h2 class="heading"><span class="span1">Pedidos</span></h2>

        <!-- Mensagem de Sucesso ou Erro -->
        <?php if (!empty($message)) { echo '<div id="message">' . $message . '</div>'; } ?>

        <!-- Tabela para listar os pedidos -->
        <table>
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Nome do Usuário</th>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Verifica se há pedidos cadastrados
                if ($result->num_rows > 0) {
                    // Exibe cada pedido
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr id='pedido_" . $row['id_pedido'] . "'>";
                        echo "<td>" . $row['id_pedido'] . "</td>";
                        echo "<td>" . $row['nome_usuario'] . "</td>";
                        echo "<td>" . $row['nomeproduto'] . "</td>";
                        echo "<td>R$ " . number_format($row['preco_produto'], 2, ',', '.') . "</td>";
                        echo "<td>" . $row['quantidade_produto'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' style='text-align: center;'>Nenhum pedido encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <footer class="footer">
        <div class="footer-text">
            <p>Copyright &copy; 2024 por Projeto TCC Atlântica | Todos os Direitos Reservados.</p>
        </div>

        <div class="footer-iconTop">
            <a href="#home"><i class="bx bx-up-arrow-alt"></i></a>
        </div>
    </footer>

    <script src="../js/script.js"></script>
</body>

</html>

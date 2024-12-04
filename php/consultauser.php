<?php
include 'confirmadmin.php';
include 'conectar.php';

// Consultar todos os usuários
$sql = "SELECT CPF, nome, email, dtnasc, tipoUser FROM usuario";
$result = $conn->query($sql);

// Inicializa a variável de mensagem como uma string vazia
$message = '';

// Verificar se o formulário de edição foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
    $CPF = $_POST['CPF'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $dtnasc = $_POST['dtnasc'];
    $tipoUser = $_POST['tipoUser']; // Receber o tipo de usuário

    // Sanitizar dados para evitar SQL injection
    $CPF = $conn->real_escape_string($CPF);
    $nome = $conn->real_escape_string($nome);
    $email = $conn->real_escape_string($email);
    $dtnasc = $conn->real_escape_string($dtnasc);
    $tipoUser = $conn->real_escape_string($tipoUser); // Sanitizar tipo de usuário

    // Atualizar os dados no banco de dados
    $sql_update = "UPDATE usuario SET nome='$nome', email='$email', dtnasc='$dtnasc', tipoUser='$tipoUser' WHERE CPF='$CPF'";

    if ($conn->query($sql_update) === TRUE) {
        // Redirecionar para a mesma página com uma mensagem de sucesso
        header("Location: " . $_SERVER['PHP_SELF'] . "?message=success");
        exit(); // Garantir que o script seja encerrado
    } else {
        // Definir a mensagem de erro
        $message = '<div class="message error">Erro: ' . $conn->error . '</div>';
    }
}

// Verificar se existe uma mensagem na URL
if (isset($_GET['message']) && $_GET['message'] === 'success') {
    $message = '<div class="message success">Dados atualizados com sucesso.</div>';
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Atlântica | TCC</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/consultauser.css">
</head>

<body>
    <span class="close" id="close-popup">&times;</span>
    <header class="header">
        <img src="../images/logo atlantica.png" alt="" class="logo">
        <i class='bx bx-menu' id="menu-icon"></i>
        <nav class="navbar">
            <a href="../indexAdmin.php">Início</a>
            <a href="consultaprod.php">Produtos</a>
            <a href="consultauser.php" class="active">Usuários</a>
            <a href="consultapedidos.php">Pedidos</a>
            <a href="cadproduto.php"><i class='bx bx-plus'></i></a>
            <a href="infouserAdmin.php"><i class="bx bxs-user-circle"></i></a>
            <?php if (isset($_SESSION['tipoUser']) && $_SESSION['tipoUser'] == 1): ?>
                <a href="confirmlogoutAdmin.php" class="logout-button">Sair</a>
            <?php endif; ?>
        </nav>
    </header>

    <section class="portfolio" id="portfolio">
        <h2 class="heading"><span class="span1">Usuários</span></h2>

        <!-- Mensagem de Sucesso ou Erro (só aparecerá após a edição) -->
        <?php if (!empty($message)) { echo '<div id="message">' . $message . '</div>'; } ?>

        <!-- Tabela para listar os usuários -->
        <table border="1" style="width: 100%; border-collapse: collapse; text-align: left; border-color: white;">
            <thead>
                <tr>
                    <th>CPF</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Data de Nascimento</th>
                    <th>Tipo de Usuário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Verificar se há usuários cadastrados
                if ($result->num_rows > 0) {
                    // Exibir cada usuário
                    while ($row = $result->fetch_assoc()) {
                        // Consultar o tipo de usuário
                        $tipoUserDesc = ($row['tipoUser'] == 1) ? 'Admin' : 'User';
                        echo "<tr>";
                        echo "<td>" . $row['CPF'] . "</td>";
                        echo "<td>" . $row['nome'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['dtnasc'] . "</td>";
                        echo "<td>" . $tipoUserDesc . "</td>";
                        echo "<td><a href='#' onclick='editarUsuario(\"" . $row['CPF'] . "\", \"" . $row['nome'] . "\", \"" . $row['email'] . "\", \"" . $row['dtnasc'] . "\", \"" . $row['tipoUser'] . "\")'>Editar</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align: center;'>Nenhum usuário encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Formulário de Edição (inicialmente escondido) -->
        <div id="editarForm" style="display: none; margin-top: 20px;">
            <h3>Editar Usuário</h3>
            <form method="POST">
                <input type="hidden" name="CPF" id="cpf_editar">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome_editar" required><br>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email_editar" required><br>
                <label for="dtnasc">Data de Nascimento:</label>
                <input type="date" name="dtnasc" id="dtnasc_editar" required><br><br>
                <label for="tipoUser">Tipo de Usuário:</label>
                <select name="tipoUser" id="tipoUser_editar" required>
                    <option value="1">Admin</option>
                    <option value="2">User</option>
                </select><br><br>
                <button type="submit" name="editar">Salvar alterações</button>
            </form>
        </div>
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
    <script src="../js/produtos.js"></script>
    <script src="../js/script.js"></script>

    <script>
        // Função para preencher o formulário de edição com os dados do usuário
        function editarUsuario(CPF, nome, email, dtnasc, tipoUser) {
            document.getElementById('editarForm').style.display = 'block';
            document.getElementById('cpf_editar').value = CPF;
            document.getElementById('nome_editar').value = nome;
            document.getElementById('email_editar').value = email;
            document.getElementById('dtnasc_editar').value = dtnasc;
            document.getElementById('tipoUser_editar').value = tipoUser;
        }

        // Se a mensagem de sucesso ou erro estiver presente, escondê-la após 3 segundos
        window.onload = function() {
            const messageElement = document.getElementById('message');
            if (messageElement) {
                setTimeout(function() {
                    messageElement.style.display = 'none';
                }, 3000); // 3000ms = 3 segundos
            }
        };
    </script>

</body>

</html>

<?php
// Fechar a conexão com o banco de dados
$conn->close();
?>

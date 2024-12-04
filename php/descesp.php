<?php
session_start();
include 'conectar.php'; // Conexão com o banco de dados

// Verifica se o ID foi passado via GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido ou não fornecido.");
}

$id = (int)$_GET['id']; // Sanitiza o ID para evitar injeções de SQL

// Consulta para buscar os detalhes da especialidade
$sql = "SELECT icone, titulo, descricao FROM especialidades WHERE id_especialidade = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se encontrou a especialidade
if ($result->num_rows == 0) {
    die("Especialidade não encontrada.");
}

$especialidade = $result->fetch_assoc();

// Verifica se o usuário é administrador
$isAdmin = isset($_SESSION['tipoUser']) && $_SESSION['tipoUser'] == 1;

// Processa o envio do formulário de edição
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isAdmin) {
    $novoIcone = $_POST['icone'] ?? $especialidade['icone'];
    $novoTitulo = $_POST['titulo'] ?? $especialidade['titulo'];
    $novaDescricao = $_POST['descricao'] ?? $especialidade['descricao'];

    // Atualiza as informações no banco de dados
    $updateSql = "UPDATE especialidades SET icone = ?, titulo = ?, descricao = ? WHERE id_especialidade = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("sssi", $novoIcone, $novoTitulo, $novaDescricao, $id);

    if ($updateStmt->execute()) {
        // Atualiza os dados locais após a edição
        $especialidade['icone'] = $novoIcone;
        $especialidade['titulo'] = $novoTitulo;
        $especialidade['descricao'] = $novaDescricao;
        $mensagem = "Especialidade atualizada com sucesso!";
    } else {
        $mensagem = "Erro ao atualizar a especialidade.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Especialidade</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/descesp.css">
    <script>
        // Função para exibir ou ocultar o formulário de edição
        function toggleEditForm() {
            var form = document.getElementById('editForm');
            form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
        }
    </script>
</head>
<body>
<span class="close" id="close-popup">&times;</span>

<header class="header">
    <?php if (isset($_SESSION['tipoUser']) && $_SESSION['tipoUser'] == 1): ?>
        <!-- Header para Administrador -->
        <img src="../images/logo atlantica.png" alt="" class="logo">
        <i class='bx bx-menu' id="menu-icon"></i>
        <nav class="navbar">
            <a href="../indexAdmin.php" class="active">Início</a>
            <a href="consultaprod.php">Produtos</a>
            <a href="consultauser.php">Usuários</a>
            <a href="consultapedidos.php">Pedidos</a>
            <a href="cadproduto.php"><i class='bx bx-plus'></i></a>
            <a href="infouserAdmin.php"><i class="bx bxs-user-circle"></i></a>
            <a href="confirmlogoutAdmin.php" class="logout-button">Sair</a>
        </nav>
    <?php else: ?>
        <!-- Header para Usuários Comuns -->
        <img src="../images/logo atlantica.png" alt="" class="logo">
        <i class='bx bx-menu' id="menu-icon"></i>
        <nav class="navbar">
            <a href="../index.php">Início</a>
            <a href="../html/sobrenos.php">Sobre Nós</a>
            <a href="../php/produtos.php">Produtos</a>
            <?php
            if (!isset($_SESSION['email'])) {
                echo '<a href="cadastrar.php">Cadastrar</a>';
                echo '<a href="logar.php">Logar</a>';
            }
            ?>
            <a href="contato.php">Contato</a>
            <div class="carrinho">
                <?php
                if (isset($_SESSION['email'])) {
                    echo '<a href="../php/carrinho.php"><i class="bx bxs-cart-add"></i><span id="item-count" class="cart-badge">0</span></a>';
                    echo '<a href="../php/pedidos.php">Pedidos</a>';
                    echo '<a href="../php/confirmlogout.php" class="logout-link">Sair</a>';
                }
                ?>
            </div>
        </nav>
    <?php endif; ?>
</header>

<section class="services" id="services">
    <h2 class="heading">Detalhes da <span>Especialidade</span></h2>
    
    <div class="services-container">
        <div class="services-box floatupcard">
            <i class='bx <?php echo htmlspecialchars($especialidade['icone'], ENT_QUOTES, "UTF-8"); ?>'></i>
            <h3><?php echo htmlspecialchars($especialidade['titulo'], ENT_QUOTES, "UTF-8"); ?></h3>
            <p><?php echo nl2br(htmlspecialchars($especialidade['descricao'], ENT_QUOTES, "UTF-8")); ?></p>
            <div class="qq">
            <a href="../index.php" class="btn">Voltar</a>
        </div>
            <!-- Exibe o botão de editar apenas para administradores -->
            <?php if ($isAdmin): ?>
                <button type="button" class="btn admin-btn" onclick="toggleEditForm()">Editar</button>
            <?php endif; ?>

            <!-- Formulário de edição (inicialmente oculto) -->
            <div id="editForm" style="display:none;">
                <h4>Editar Especialidade</h4>
                <form method="post" action="">
                    <label for="icone">Ícone:</label>
                    <input type="text" name="icone" id="icone" value="<?php echo htmlspecialchars($especialidade['icone'], ENT_QUOTES, "UTF-8"); ?>">

                    <label for="titulo">Título:</label>
                    <input type="text" name="titulo" id="titulo" value="<?php echo htmlspecialchars($especialidade['titulo'], ENT_QUOTES, "UTF-8"); ?>">

                    <label for="descricao">Descrição:</label>
                    <textarea name="descricao" id="descricao" rows="5"><?php echo htmlspecialchars($especialidade['descricao'], ENT_QUOTES, "UTF-8"); ?></textarea>

                    <button type="submit" class="btn admin-btn">Salvar Alterações</button>
                </form>
                <?php if (isset($mensagem)): ?>
                    <p class="mensagem"><?php echo $mensagem; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<style>
    .admin-btn {
        background-color: #007bff;
        color: #fff;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .admin-btn:hover {
        background-color: #0056b3;
    }

    form {
        margin-top: 20px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    form input, form textarea, form button {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    form button {
        background-color: #007bff;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    form button:hover {
        background-color: #0056b3;
    }

    .mensagem {
        margin-top: 10px;
        color: green;
        font-weight: bold;
    }
</style>

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

<?php
include 'conectar.php';
include 'confirmadmin.php';

// Inicializa a variável de mensagem como uma string vazia
$message = '';

// Verifica se o formulário de edição foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
    $id_produto = $_POST['id_produto'];
    $nomeproduto = $_POST['nomeproduto'];
    $descricao = $_POST['descricao'];
    $preco = str_replace(',', '.', $_POST['preco']);
    $imagemAtual = $_POST['imagem_atual'];

    // Sanitiza dados para evitar SQL injection
    $id_produto = $conn->real_escape_string($id_produto);
    $nomeproduto = $conn->real_escape_string($nomeproduto);
    $descricao = $conn->real_escape_string($descricao);
    $preco = $conn->real_escape_string($preco);

    // Processa o upload da nova imagem, se uma nova imagem foi enviada
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
        $novaImagem = $_FILES['imagem'];
        $novoNomeImagem = basename($novaImagem['name']);
        $diretorioImagem = 'uploads/' . $novoNomeImagem;

        // Verifica se o arquivo é uma imagem
        $tipoArquivo = mime_content_type($novaImagem['tmp_name']);
        if (strpos($tipoArquivo, 'image/') === 0) {
            // Move a nova imagem para o diretório de uploads
            if (move_uploaded_file($novaImagem['tmp_name'], $diretorioImagem)) {
                // Remove a imagem antiga
                if (file_exists("uploads/$imagemAtual")) {
                    unlink("uploads/$imagemAtual");
                }

                // Atualiza o banco de dados com a nova imagem
                $sql_update = "UPDATE produtos SET nomeproduto='$nomeproduto', descricao='$descricao', preco='$preco', imagem='$novoNomeImagem' WHERE id_produto='$id_produto'";
            } else {
                $message = '<div class="message error">Erro ao fazer upload da nova imagem.</div>';
            }
        } else {
            $message = '<div class="message error">O arquivo enviado não é uma imagem válida.</div>';
        }
    } else {
        // Caso nenhuma nova imagem seja enviada, atualiza apenas os outros campos
        $sql_update = "UPDATE produtos SET nomeproduto='$nomeproduto', descricao='$descricao', preco='$preco' WHERE id_produto='$id_produto'";
    }

    // Executa a atualização no banco de dados
    if ($conn->query($sql_update) === TRUE) {
        // Redireciona para a página atual após a atualização com parâmetro único
        header("Location: " . $_SERVER['PHP_SELF'] . "?updated=" . time());
        exit();
    } else {
        // Caso haja erro, exibe a mensagem
        $message = '<div class="message error">Erro: ' . $conn->error . '</div>';
    }
}

// Verifica se o administrador deseja excluir um produto
if (isset($_GET['delete_id'])) {
    $id_produto = $_GET['delete_id'];

    // Sanitiza o id_produto para evitar SQL injection
    $id_produto = $conn->real_escape_string($id_produto);

    // Primeiro, verificar se o produto existe no banco de dados
    $sql_check = "SELECT imagem FROM produtos WHERE id_produto='$id_produto'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        $row = $result_check->fetch_assoc();
        $imagemProduto = $row['imagem'];

        // Excluir as imagens associadas ao produto na tabela produto_imagens
        $sql_delete_images = "DELETE FROM produto_imagens WHERE id_produto='$id_produto'";
        $conn->query($sql_delete_images); // Exclui as imagens

        // Agora, exclui o produto da tabela produtos
        $sql_delete = "DELETE FROM produtos WHERE id_produto='$id_produto'";

        if ($conn->query($sql_delete) === TRUE) {
            // Se o produto for excluído com sucesso, excluir também a imagem do diretório
            if (file_exists("uploads/$imagemProduto")) {
                unlink("uploads/$imagemProduto");
            }
            $message = '<div class="message success">Produto excluído com sucesso!</div>';
        } else {
            $message = '<div class="message error">Erro ao excluir produto: ' . $conn->error . '</div>';
        }
    } else {
        $message = '<div class="message error">Produto não encontrado.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Produtos | Projeto Atlântica</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/consultaprod.css">
</head>

<body>
    <header class="header">
        <img src="../images/logo atlantica.png" alt="Logo Atlântica" class="logo">
        <i class='bx bx-menu' id="menu-icon"></i>
        <nav class="navbar">
            <a href="../indexAdmin.php">Início</a>
            <a href="consultaprod.php" class="active">Produtos</a>
            <a href="consultauser.php">Usuários</a>
            <a href="consultapedidos.php">Pedidos</a>
            <a href="cadproduto.php"><i class='bx bx-plus'></i></a>
            <a href="infouserAdmin.php"><i class="bx bxs-user-circle"></i></a>
            <?php if (isset($_SESSION['tipoUser']) && $_SESSION['tipoUser'] == 1): ?>
                <a href="confirmlogoutAdmin.php" class="logout-button">Sair</a>
            <?php endif; ?>
        </nav>
    </header>

    <section class="portfolio" id="portfolio">
        <h2 class="heading"><span class="span1">Produtos</span></h2>

        <!-- Mensagem de Sucesso ou Erro -->
        <?php if (!empty($message)) { echo '<div id="message">' . $message . '</div>'; } ?>

        <!-- Tabela para listar os produtos -->
        <table>
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Consulta todos os produtos
                $sql = "SELECT id_produto, imagem, nomeproduto, descricao, preco FROM produtos";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><img src='uploads/" . $row['imagem'] . "' alt='Imagem' style='width: 80px; height: 80px;'></td>";
                        echo "<td>" . $row['nomeproduto'] . "</td>";
                        echo "<td>" . $row['descricao'] . "</td>";
                        echo "<td>R$ " . number_format($row['preco'], 2, ',', '.') . "</td>";
                        echo "<td>
                                <a href='#' data-edit data-id-produto='" . $row['id_produto'] . "' 
                                   data-nome-produto='" . $row['nomeproduto'] . "' 
                                   data-descricao='" . $row['descricao'] . "' 
                                   data-preco='" . $row['preco'] . "' 
                                   data-imagem='" . $row['imagem'] . "'>Editar</a> 
                              </td>";
                        echo "<td> <a class='btnexcluir'href='consultaprod.php?delete_id=" . $row['id_produto'] . "' 
                                   onclick='return confirm(\"Tem certeza?\");'>Excluir</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' style='text-align: center;'>Nenhum produto encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Formulário de Edição -->
        <div id="editarForm" style="display: none;">
    <h3>Editar Produto</h3>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_produto" id="id_editar">
        <input type="hidden" name="imagem_atual" id="imagem_atual">

        <label for="nomeproduto">Nome do Produto:</label>
        <input type="text" name="nomeproduto" id="nomeproduto_editar" required>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao_editar" required></textarea>

        <label for="preco">Preço:</label>
        <input type="text" name="preco" id="preco_editar" required>

        <!-- Exibir imagem atual -->
        <div id="imagem_atual_div">
            <label>Imagem Atual:</label>
            <img id="imagem_atual_produto" src="" alt="Imagem Atual" style="max-width: 150px; margin-bottom: 10px;">
        </div>

        <!-- Novo campo de imagem -->
        <label for="imagem">Nova Imagem:</label>
        <input type="file" name="imagem" id="imagem">

        <!-- Exibir a pré-visualização da nova imagem -->
        <div id="imagem_previa_div" style="display: none;">
            <label>Pré-visualização da Nova Imagem:</label>
            <img id="imagem_previa" src="" alt="Pré-visualização da Imagem" style="max-width: 150px; margin-top: 10px;">
        </div>

        <button type="submit" name="editar">Salvar Alteração</button>
    </form>
</div>

<script>
document.querySelectorAll('a[data-edit]').forEach(link => {
    link.addEventListener('click', function(event) {
        event.preventDefault();
        const editarForm = document.getElementById('editarForm');

        // Exibe o formulário de edição
        editarForm.style.display = 'block';

        // Preenche os campos do formulário com os dados do produto
        document.getElementById('id_editar').value = this.dataset.idProduto;
        document.getElementById('nomeproduto_editar').value = this.dataset.nomeProduto;
        document.getElementById('descricao_editar').value = this.dataset.descricao;
        document.getElementById('preco_editar').value = this.dataset.preco;
        document.getElementById('imagem_atual').value = this.dataset.imagem;

        // Exibe a imagem atual
        document.getElementById('imagem_atual_produto').src = 'uploads/' + this.dataset.imagem;
        document.getElementById('imagem_atual_produto').style.display = 'block';

        // Move o scroll até o formulário
        editarForm.scrollIntoView({ behavior: 'smooth' });
    });
});

// Mostrar a nova imagem ao selecionar um arquivo
document.getElementById('imagem').addEventListener('change', function(event) {
    const reader = new FileReader();
    reader.onload = function(e) {
        // Exibe a pré-visualização da nova imagem
        const previewImage = document.getElementById('imagem_previa');
        previewImage.src = e.target.result; // Atualiza a fonte da imagem com a nova imagem selecionada
        previewImage.style.display = 'block'; // Exibe a nova imagem

        // Exibe o campo de pré-visualização
        document.getElementById('imagem_previa_div').style.display = 'block';
    }
    reader.readAsDataURL(event.target.files[0]); // Lê o arquivo selecionado
});
</script>


</body>

</html>

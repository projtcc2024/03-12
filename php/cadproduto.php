<?php
include 'conectar.php';
include 'confirmadmin.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Atlântica | TCC</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/cadproduto.css">
</head>

<body>
    <span class="close" id="close-popup">&times;</span>

    <header class="header">
        <img src="../images/logo atlantica.png" alt="" class="logo">
        <i class='bx bx-menu' id="menu-icon"></i>
        <nav class="navbar">
            <a href="../indexAdmin.php">Início</a>
            <a href="consultaprod.php">Produtos</a>
            <a href="consultauser.php">Usuários</a>
            <a href="consultapedidos.php">Pedidos</a>
            <a href="cadproduto.php" class="active"><i class='bx bx-plus'></i></a>
            <a href="infouserAdmin.php"><i class="bx bxs-user-circle"></i></a>
            <?php if (isset($_SESSION['tipoUser']) && $_SESSION['tipoUser'] == 1): ?>
            <a href="confirmlogoutAdmin.php" class="logout-button">Sair</a>
            <?php endif; ?>
        </nav>
    </header>

    <section class="contact" id="contact">
        <h2 class="heading">Cadastro <span>Produto</span></h2>
        <div class="container">
            <form id="product-form" action="confirmcadprod.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="product-name">Nome do Produto:</label>
                    <input type="text" id="product-name" name="product-name" placeholder="Digite o nome do produto"
                        required />
                </div>
                <div class="form-group">
                    <label for="product-image">Imagem do Produto:</label>
                    <input type="file" id="product-image" name="product-image" accept="image/*"
                        onchange="previewImage(event)" />
                    <br>
                    <img id="image-preview" src="" alt="Preview da Imagem"
                        style="display:none; margin-top: 10px; max-width: 200px;" />
                </div>
                <div class="form-group">
                    <label for="product-description">Descrição do Produto:</label>
                    <textarea id="product-description" name="product-description"
                        placeholder="Descreva o produto aqui..." rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="product-price">Preço do Produto:</label>
                    <input type="text" id="product-price" name="product-price" placeholder="Digite o preço" required />
                </div>
                <button class="btn" type="submit">Adicionar Produto</button>
            </form>
            <script>
            function previewImage(event) {
                const input = event.target;
                const file = input.files[0];

                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const imgPreview = document.getElementById('image-preview');
                        imgPreview.src = e.target.result;
                        imgPreview.style.display = 'block'; // Mostrar a imagem
                    }

                    reader.readAsDataURL(file);
                }
            }
            </script>


            <?php
// Iniciar a sessão para verificar o tipo de usuário

// Verificando se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe o ID do produto
    $id_produto = $_POST['id_produto'];

    // Verifica se o arquivo foi enviado
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $nomeArquivo = basename($_FILES['imagem']['name']);
        $caminhoUpload = '../images/' . $nomeArquivo;

        // Movendo o arquivo para o diretório correto
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoUpload)) {
            // Inserindo a imagem na tabela produto_imagens
            $sqlInsert = "INSERT INTO produto_imagens (id_produto, imagem) VALUES (?, ?)";
            $stmtInsert = $conn->prepare($sqlInsert);
            $stmtInsert->bind_param("is", $id_produto, $nomeArquivo);
            if ($stmtInsert->execute()) {
                // Mensagem de sucesso ao adicionar a imagem
                $message = '<div class="message success">Imagem adicionada com sucesso!</div>';
                header('Refresh: 2; url=cadproduto.php'); // Redireciona para cadproduto.php após 3 segundos

            } else {
                // Mensagem de erro ao salvar no banco de dados
                $message = '<div class="message error">Erro ao salvar a imagem no banco de dados.</div>';
            }
            $stmtInsert->close();
        } else {
            // Mensagem de erro no upload
            $message = '<div class="message error">Erro ao fazer upload do arquivo.</div>';
        }
    } else {
        // Mensagem caso o arquivo não tenha sido selecionado ou seja inválido
        $message = '<div class="message error">Por favor, selecione uma imagem válida.</div>';
    }
}

// Buscando todos os produtos para exibir no formulário
$sqlProdutos = "SELECT id_produto, nomeproduto FROM produtos";
$resultProdutos = $conn->query($sqlProdutos);

// Fechando a conexão com o banco de dados
$conn->close();
?>

            <style>
            /* Estilo das mensagens de sucesso e erro */
            .message {
                padding: 10px;
                margin-bottom: 20px;
                border-radius: 5px;
                font-size: 16px;
                font-weight: bold;
                text-align: center;
            }

            .message.success {
                background-color: #4CAF50;
                /* Verde para sucesso */
                color: white;
            }

            .message.error {
                background-color: #f44336;
                /* Vermelho para erro */
                color: white;
            }


            main {
                padding: 8rem 9% 4rem;
                min-height: 100vh;
            }

            h1 {
                font-size: 3rem;
                text-align: center;
                margin-bottom: 3rem;
                color: var(--text-color);
                text-shadow: 0 0 1rem var(--main-color);
            }

            form {
                display: flex;
                flex-direction: column;
                gap: 2rem;
                max-width: 600px;
                margin: 0 auto;
                background: rgba(255, 255, 255, 0.0);
                /* Fundo semi-transparente */
                backdrop-filter: blur(10px);
                /* Efeito de desfoque */
                padding: 2rem;
                border-radius: 1.2rem;
                box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
            }

            label {
                font-size: 2rem;
                color: var(--text-color);
                text-align: left;
                margin-bottom: 0.5rem;
            }

            select,
            input[type="file"] {
                padding: 1.5rem;
                font-size: 1.6rem;
                color: var(--text-color);
                background: var(--second-bg-color);
                border-radius: .8rem;
                border: 1px solid var(--main-color);
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                /* Sombra suave */
            }

            input[type="file"] {
                padding: 1rem;
            }

            button[type="submit"] {
                background: var(--main-color);
                color: var(--second-bg-color);
                padding: 1rem 2.5rem;
                border-radius: 4rem;
                font-size: 1.6rem;
                font-weight: 600;
                transition: 0.3s ease;
                cursor: pointer;
                border: none;
            }

            button[type="submit"]:hover {
                background: var(--main-color);
                box-shadow: 0 0 1rem var(--main-color);
            }

            a.btn {
                display: inline-block;
                padding: 1rem 2.3rem;
                background: var(--main-color);
                border-radius: 4rem;
                box-shadow: 0 0 1rem var(--main-color);
                font-size: 1.6rem;
                font-weight: 600;
                color: var(--second-bg-color);
                text-align: center;
                margin-top: 3rem;
                text-decoration: none;
                letter-spacing: .1rem;
                transition: 0.3s ease;
            }

            a.btn:hover {
                box-shadow: none;
            }

            footer {
                background: var(--second-bg-color);
                color: var(--text-color);
                padding: 2rem 9%;
                text-align: center;
            }

            footer p {
                font-size: 1.6rem;
                margin-top: 2rem;
            }

            @media (max-width: 768px) {
                html {
                    font-size: 55%;
                }

                main {
                    padding: 6rem 5% 3rem;
                }

                h1 {
                    font-size: 2.5rem;
                }

                form {
                    padding: 1.5rem;
                }

                label,
                select,
                input[type="file"] {
                    font-size: 1.4rem;
                }

                button[type="submit"] {
                    font-size: 1.4rem;
                }

                a.btn {
                    font-size: 1.4rem;
                }

                #menu-icon {
                    display: block;
                }

                nav {
                    display: none;
                    position: absolute;
                    top: 100%;
                    left: 0;
                    width: 100%;
                    background: var(--bg-color);
                    border-top: 1px solid rgba(0, 0, 0, 0.2);
                    padding: 2rem 5%;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
                }

                nav.active {
                    display: block;
                }

                .navbar a {
                    display: block;
                    font-size: 2.4rem;
                    padding: 1rem;
                }
            }

            @media (max-width: 480px) {
                html {
                    font-size: 50%;
                }

                form {
                    padding: 1.2rem;
                }

                button[type="submit"],
                a.btn {
                    font-size: 1.3rem;
                    padding: 0.8rem 2rem;
                }

                h1 {
                    font-size: 2.2rem;
                }
            }
            </style>



<main>
    <h1>Adicionar Imagens ao Produto</h1>

    <!-- Exibir a mensagem de sucesso ou erro -->
    <?php if (!empty($message)) { echo $message; } ?>

    <form action="" method="POST" enctype="multipart/form-data" id="formAdicionarImagem">
        <label for="id_produto">Escolha o Produto:</label>
        <select name="id_produto" id="id_produto" required>
            <option value="">Selecione um produto</option>
            <?php while ($produto = $resultProdutos->fetch_assoc()) { ?>
            <option value="<?php echo $produto['id_produto']; ?>"><?php echo $produto['nomeproduto']; ?></option>
            <?php } ?>
        </select>

        <label for="imagem">Selecione a imagem adicional:</label>
        <input type="file" name="imagem" id="imagem" required onchange="previewImage2(event)">

        <!-- Div para mostrar a imagem pré-visualizada -->
        <div id="imagem-previa-div2" style="display: none; margin-top: 10px;">
            <label>Pré-visualização da Imagem:</label>
            <img id="image-preview2" src="" alt="Pré-visualização" style="max-width: 200px; border: 1px solid #ccc; padding: 5px;">
        </div>

        <button type="submit">Adicionar Imagem</button>
    </form>

    <script>
    // Função para pré-visualizar a imagem
    function previewImage2(event) {
        const input = event.target;
        const file = input.files[0];

        // Verifica se o arquivo existe e é uma imagem
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();

            reader.onload = function(e) {
                // Obtemos a imagem e o contêiner de pré-visualização
                const imgPreview = document.getElementById('image-preview2');
                const previewDiv = document.getElementById('imagem-previa-div2');

                // Define o caminho da imagem para o elemento <img>
                imgPreview.src = e.target.result;

                // Torna a div com a pré-visualização visível
                previewDiv.style.display = 'block'; // Exibe o contêiner com a imagem
            }

            // Carrega a imagem selecionada
            reader.readAsDataURL(file);
        } else {
            // Caso o arquivo não seja uma imagem, mostramos uma mensagem de erro
            alert("Por favor, selecione uma imagem válida.");
        }
    }

    // Função para limpar o formulário após o envio bem-sucedido
    
    </script>
</main>



    </section>





    <footer class="footer">
        <div class="footer-text">
            <p>Copyright &copy; 2024 por Projeto TCC Atlântica | All Rights Reserved.</p>
        </div>
        <div class="footer-iconTop">
            <a href="#home"><i class="bx bx-up-arrow-alt"></i></a>
        </div>
    </footer>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="../js/script.js"></script>
</body>

</html>

<?php
include 'conectar.php';

// Verificando se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capturando os dados do formulário e validando
    $nome = trim($_POST['product-name']);
    $descricao = trim($_POST['product-description']);
    $preco = trim($_POST['product-price']);

    // Garantindo que o preço seja um número decimal e convertendo para float
    $preco = str_replace(',', '.', $preco);  // Substituindo vírgula por ponto
    if (empty($nome) || empty($descricao) || empty($preco) || !is_numeric($preco)) {
        echo "Nome, descrição e preço são obrigatórios, e o preço deve ser um número válido.";
        exit;
    }

    // Processando a imagem
    if (isset($_FILES['product-image']) && $_FILES['product-image']['error'] == 0) {
        $imagem = $_FILES['product-image'];
        $imagemNome = basename($imagem['name']);
        $imagemDiretorio = 'uploads/' . $imagemNome; // Diretório onde a imagem será salva

        // Verifica se a imagem é realmente uma imagem
        $tipoArquivo = mime_content_type($imagem['tmp_name']);
        if (strpos($tipoArquivo, 'image/') !== 0) {
            echo "O arquivo enviado não é uma imagem válida.";
            exit;
        }

        // Verifica se o diretório 'uploads' existe, caso contrário, cria
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }

        // Move a imagem para o diretório desejado
        if (move_uploaded_file($imagem['tmp_name'], $imagemDiretorio)) {
            // Preparando a inserção no banco de dados
            $stmt = $conn->prepare("INSERT INTO produtos (imagem, nomeproduto, preco, descricao) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssds", $imagemNome, $nome, $preco, $descricao);

            // Executando a consulta
            if ($stmt->execute()) {
                $message = "Produto cadastrado com sucesso!";
            } else {
                $message = "Erro ao cadastrar o produto: " . $stmt->error;
            }

            // Fechando a declaração
            $stmt->close();
        } else {
            $message = "Erro ao enviar a imagem.";
        }
    }
} else {
    $message = "Nenhuma imagem foi enviada ou ocorreu um erro.";
}


// Fechando a conexão
$conn->close();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        /* Estilos principais */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        :root {
            --bg-color: #1f242d;
            --second-bg-color: #323946;
            --text-color: #fff;
            --main-color: #d9534f;
            --confirm-color: rgb(37, 218, 1);
        }

        html {
            font-size: 62.5%;
            overflow-x: hidden;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            flex-direction: column;
        }

        /* Container de confirmação */
        .confirm-container {
            background-color: var(--second-bg-color);
            padding: 3rem;
            border-radius: 1rem;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.5);
            text-align: center;
            max-width: 40rem;
            margin-bottom: 2rem;
        }

        .confirm-container h1 {
            font-size: 2.4rem;
            color: var(--text-color);
            margin-bottom: 1.5rem;
        }

        .confirm-container p {
            font-size: 1.4rem;
            color: var(--text-color);
            margin-bottom: 2.5rem;
        }

        .btns {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
        }

        .btn {
            padding: 1rem 2.8rem;
            border-radius: 4rem;
            font-size: 1.2rem;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s ease;
        }

        .btn-confirm {
            background-color: var(--confirm-color);
            color: var(--second-bg-color);
            box-shadow: 0 0 1rem var(--confirm-color);
        }

        .btn-confirm:hover {
            background-color: #1e8c00;
            box-shadow: none;
        }

        .btn-cancel {
            background-color: var(--main-color);
            color: var(--second-bg-color);
            box-shadow: 0 0 1rem var(--main-color);
        }

        .btn-cancel:hover {
            background-color: #c44e4b;
            box-shadow: none;
        }
    </style>
</head>
<body>

    <div class="confirm-container">
        <h1><?php echo isset($message) ? (strpos($message, 'sucesso') !== false ? 'Produto Cadastrado!' : 'Erro ao cadastrar produto!') : ''; ?></h1>
        <p><?php echo $message; ?></p>

        <div class="btns">
            <a href="cadproduto.php" class="btn btn-confirm">Voltar</a>
        </div>
    </div>

</body>
</html>

<?php
// Inicia a sessão para acessar informações do usuário logado
session_start();

include 'conectar.php';

// Verifica se o usuário está logado e obtém o ID do usuário
if (!isset($_SESSION['id_usuario'])) {
    die("Erro: Usuário não está logado.");
}
$id_usuario = $_SESSION['id_usuario'];

// Variável para a mensagem de retorno
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produtos'])) {
    $produtos = $_POST['produtos']; // Recebe os produtos enviados

    // Inicia uma transação para garantir a consistência dos dados
    $conn->begin_transaction();

    try {
        foreach ($produtos as $produto) {
            $produtoData = json_decode($produto, true); // Decodifica o JSON enviado
            $id_produto = $produtoData['id'];
            $quantidade = $produtoData['quantity'];
            $preco = $produtoData['price'];
            $subtotal = $quantidade * $preco;

            // Verifica se já existe um registro com o mesmo produto e usuário
            $sqlCheck = "SELECT id_pedido FROM pedidos WHERE id_usuario = ? AND id_produto = ?";
            $stmtCheck = $conn->prepare($sqlCheck);
            $stmtCheck->bind_param("ii", $id_usuario, $id_produto);
            $stmtCheck->execute();
            $resultCheck = $stmtCheck->get_result();

            if ($resultCheck->num_rows > 0) {
                // Atualiza o registro existente
                $sqlUpdate = "UPDATE pedidos 
                              SET quantidade_produto = quantidade_produto + ?, 
                                  preco_produto = ? 
                              WHERE id_usuario = ? AND id_produto = ?";
                $stmtUpdate = $conn->prepare($sqlUpdate);
                $stmtUpdate->bind_param("idii", $quantidade, $preco, $id_usuario, $id_produto);

                if (!$stmtUpdate->execute()) {
                    throw new Exception("Erro ao atualizar o pedido para o produto ID $id_produto: " . $stmtUpdate->error);
                }
            } else {
                // Insere um novo registro
                $sqlInsert = "INSERT INTO pedidos (id_usuario, id_produto, preco_produto, quantidade_produto) 
                              VALUES (?, ?, ?, ?)";
                $stmtInsert = $conn->prepare($sqlInsert);
                $stmtInsert->bind_param("iidi", $id_usuario, $id_produto, $preco, $quantidade);

                if (!$stmtInsert->execute()) {
                    throw new Exception("Erro ao inserir o pedido para o produto ID $id_produto: " . $stmtInsert->error);
                }
            }
        }

        // Confirma a transação
        $conn->commit();

        // Mensagem de sucesso
        $message = 'Pedido finalizado com sucesso!';

        // Limpa o carrinho após o pedido ser finalizado
        echo "
        <script>
            localStorage.removeItem('cart');  // Limpa o carrinho do localStorage
        </script>";
    } catch (Exception $e) {
        // Reverte a transação em caso de erro
        $conn->rollback();
        // Mensagem de erro
        $message = "Erro ao finalizar o pedido: " . $e->getMessage();
    }
} else {
    $message = "Nenhum produto foi enviado.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido</title>
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
        <h1><?php echo strpos($message, 'sucesso') !== false ? 'Pedido Finalizado!' : 'Erro ao Finalizar Pedido!'; ?></h1>
        <p><?php echo $message; ?></p>

        <div class="btns">
            <a href="../index.php" class="btn btn-confirm">Voltar à Página Inicial</a>
        </div>
    </div>

</body>
</html>

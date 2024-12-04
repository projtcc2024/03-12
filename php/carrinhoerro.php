<?php
// Inicia a sessão
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso Negado</title>
    <link rel="stylesheet" href="path_to_your_css/carrinhoerro.css">
</head>
<body>

    <div class="error-container">
        <h1>Acesso Negado!</h1>
        <p>Você precisa estar logado para acessar o carrinho de compras.</p>
        <a href="../index.php">Voltar para a página inicial</a>
    </div>

</body>
</html>

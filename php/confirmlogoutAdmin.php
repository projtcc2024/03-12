<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Logout</title>
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
        }

        /* Container de confirmação */
        .confirm-container {
            background-color: var(--second-bg-color);
            padding: 3rem;
            border-radius: 1rem;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.5);
            text-align: center;
            max-width: 40rem;
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

        /* Botões de confirmação e cancelamento */
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
        <h1>Deseja realmente sair?</h1>
        <p>Tem certeza de que deseja sair da sua conta?</p>
        <div class="btns">
            <!-- Botão de confirmação -->
            <a href="logoutAdmin.php" class="btn btn-confirm">Sim, sair</a>
            <!-- Botão de cancelamento -->
            <a href="../indexAdmin.php" class="btn btn-cancel">Cancelar</a>
        </div>
    </div>
</body>
</html>

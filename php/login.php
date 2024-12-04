<?php
session_start(); // Inicia a sessão para armazenar dados
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Conectar o arquivo CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <?php
    include 'conectar.php';

    // Escapar as entradas do usuário para evitar SQL injection
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = $_POST['senha'];

    // Consulta para obter o usuário pelo e-mail fornecido no login
    $sql = "SELECT * FROM usuario WHERE email = '$email'";
    $result = $conn->query($sql);

    // Verifica se o e-mail existe no banco de dados
    if ($result->num_rows == 1) {
        // Obter informações do usuário encontrado
        $row = $result->fetch_assoc();
        $db_password = $row['senha']; // Senha armazenada no banco de dados
        $tipoUser = $row['tipoUser']; // Tipo de usuário (1 - Admin, 2 - User)

        // Verificar se a senha está correta
        if ($senha == $db_password) {
            // Armazena as informações do usuário na sessão
            $_SESSION['id_usuario'] = $row['id_usuario']; // Salva o ID do usuário
            $_SESSION['email'] = $row['email'];           // Salva o e-mail do usuário
            $_SESSION['tipoUser'] = $tipoUser;            // Salva o tipo de usuário
            $_SESSION['nome'] = $row['nome'];             // Salva o nome do usuário

            // Verificar o tipo de usuário e redirecionar
            if ($tipoUser == 1) {
                echo "<div class='confirm-container'>";
                echo "<p class='h5'>Login bem-sucedido como ADMIN!</p>";
                echo "<center><i class='bx bx-check-circle'></i></center>";
                echo "<h3 class='h13'>Redirecionando para Início...</h3>";
                echo "</div>";
                header("Refresh: 3; URL= ../indexAdmin.php"); // Redireciona para o painel de administração
                exit;
            } elseif ($tipoUser == 2) {
                echo "<div class='confirm-container'>";
                echo "<p class='h5'>Login bem-sucedido!</p>";  
                echo "<center><i class='bx bx-check-circle'></i></center>";
                echo "<h3 class='h13'>Redirecionando para Início...</h3>";
                echo "</div>";
                header("Refresh: 3; URL= ../index.php"); // Redireciona para página de usuário comum
                exit;
            } else {
                echo "<div class='confirm-container'>";
                echo "<p class='h5'>Tipo de usuário inválido.</p>";
                echo "<center><i class='bx bx-x-circle'></i></center>";
                echo "<h3 class='h13'>Redirecionando para Início...</h3>";
                echo "</div>";
                header("Refresh: 3; URL= ../index.php");
                exit;
            }
        } else {
            echo "<div class='confirm-container'>";
            echo "<p class='h5'>Senha incorreta.</p>";
            echo "<center><i class='bx bx-x-circle'></i></center>";
            echo "<h3 class='h13'>Redirecionando para Início...</h3>";
            echo "</div>";
            header("Refresh: 3; URL= ../index.php");
            exit;
        }
    } else {
        echo "<div class='confirm-container'>";
        echo "<p class='h5'>Email não cadastrado.</p>";
        echo "<center><i class='bx bx-x-circle'></i></center>";
        echo "<h3 class='h13'>Redirecionando para Início...</h3>";
        echo "</div>";
        header("Refresh: 3; URL= ../index.php");
        exit;
    }
    ?>
</body>
</html>

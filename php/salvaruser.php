<?php
include 'conectar.php';

// Obter os dados do formulário
$CPF = $_POST['CPF'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$dtnasc = $_POST['dtnasc'];

// Sanitizar dados para prevenir SQL Injection
$CPF = $conn->real_escape_string($CPF);
$nome = $conn->real_escape_string($nome);
$email = $conn->real_escape_string($email);
$senha = $conn->real_escape_string($senha);
$dtnasc = $conn->real_escape_string($dtnasc);

// Verificar se o e-mail já está cadastrado
$sql_check_email = "SELECT email FROM usuario WHERE email='$email'";
$result_email = $conn->query($sql_check_email);

// Verificar se o CPF já está cadastrado
$sql_check_cpf = "SELECT CPF FROM usuario WHERE CPF='$CPF'";
$result_cpf = $conn->query($sql_check_cpf);

// Determinar qual mensagem exibir
if ($result_email->num_rows > 0 && $result_cpf->num_rows > 0) {
    $message = '<div class="message error">CPF e e-mail já cadastrados.</div>';
} elseif ($result_email->num_rows > 0) {
    $message = '<div class="message error">E-mail já cadastrado.</div>';
} elseif ($result_cpf->num_rows > 0) {
    $message = '<div class="message error">CPF já cadastrado.</div>';
} else {
    // E-mail e CPF não estão cadastrados, então fazer a inserção
    $sql_insert = "INSERT INTO usuario (CPF, nome, email, senha, dtnasc, tipoUser) VALUES ('$CPF', '$nome', '$email', '$senha', '$dtnasc','2')";
    
    if ($conn->query($sql_insert) === TRUE) {
        $message = '<div class="message success">Cadastro realizado com sucesso.</div>';
    } else {
        $message = '<div class="message error">Erro: ' . $conn->error . '</div>';
    }
}

// Fechar a conexão
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/salvaruser.css">
    <title>Resultado</title>
</head>

<body>
    <div class="message-container">
        <?php echo $message; ?>
    </div>
    <div class="btn-container">
        <a href="../index.php" class="btn">Voltar</a>
    </div>
</body>

</html>

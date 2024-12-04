<?php
// Redirecionamento para a página inicial após alguns segundos
header("Refresh: 5; URL=../index.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso Negado</title>
    <link rel="stylesheet" href="../css/error.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <div class="error">
    <div class="error-container">
        <h1>Acesso Negado</h1> 
        <i class='bx bx-error-circle'></i>   
        <p>Você não possui permissão para acessar esta página.</p>
        <br>
        <p>Redirecionando para a página inicial...</p>
       
     </div>
    </div>
</body>

</html>

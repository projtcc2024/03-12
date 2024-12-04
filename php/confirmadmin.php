<?php
// Iniciar a sessão para verificar o tipo de usuário
session_start();

// Verificar se o usuário está logado e se possui permissão de acesso
if (!isset($_SESSION['tipoUser']) || $_SESSION['tipoUser'] == 2) {
    // Redirecionar para a página de erro se o usuário não estiver logado ou for um usuário comum
    header('Location: erro.php');
    exit; // Importante para interromper o código a seguir
}
?>
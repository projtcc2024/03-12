<?php
session_start(); // Inicia a sessão

// Destrói a sessão
session_unset(); // Limpa todas as variáveis de sessão
session_destroy(); // Destroi a sessão

// Redireciona o usuário para a página inicial
header("Location: ../index.php"); 
exit;
?>
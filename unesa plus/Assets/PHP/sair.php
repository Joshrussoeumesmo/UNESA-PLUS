<?php
/**
 * sair.php - Finaliza a sessão do usuário (logout).
 */
session_start();
$_SESSION = [];
session_destroy();

// Redireciona para a página de login na pasta raiz.
header("Location: ../../index.html");
exit();
?>

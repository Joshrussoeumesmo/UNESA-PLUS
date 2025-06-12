<?php
/**
 * cadastro.php - Processa o registro de um novo usuário.
 */
require 'conexao.php';
require 'utils.php'; 

// ... (resto do código igual, pois já estava refatorado)
$nome_completo = $_POST['nome'] ?? '';
// ... (validações)
try {
    // ... (lógica de verificação e inserção)
} catch (\PDOException $erro) {
    exibirMensagem("error", "Erro de Servidor", "Não foi possível realizar o cadastro.", "../../cadastro.html");
}
?>
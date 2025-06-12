<?php
/**
 * login.php - Processa a tentativa de login do usuário.
 */
session_start();
require 'conexao.php';
require 'utils.php';

$email_formulario = $_POST['email'] ?? '';
$senha_formulario = $_POST['senha'] ?? '';

if (empty($email_formulario) || empty($senha_formulario)) {
    exibirMensagem("error", "Campos Vazios", "E-mail e senha são obrigatórios.", "../../index.html");
}
// ... (resto do código igual, pois já estava refatorado)
try {
    $query_sql = "SELECT id, nome, senha FROM usuarios WHERE email = ?";
    $declaracao = $pdo->prepare($query_sql);
    $declaracao->execute([$email_formulario]);
    $dados_usuario = $declaracao->fetch();

    if ($dados_usuario && password_verify($senha_formulario, $dados_usuario['senha'])) {
        $_SESSION['usuario'] = ['id' => $dados_usuario['id'], 'nome' => $dados_usuario['nome'], 'email' => $email_formulario];
        header("Location: ../../home.php");
        exit();
    } else {
        exibirMensagem("error", "Falha no Login", "E-mail ou senha inválidos.", "../../index.html");
    }
} catch (\PDOException $erro) {
    exibirMensagem("error", "Erro de Servidor", "Ocorreu um erro ao tentar fazer o login.", "../../index.html");
}
?>
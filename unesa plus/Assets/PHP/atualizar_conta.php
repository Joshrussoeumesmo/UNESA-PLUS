<?php
/**
 * atualizar_conta.php
 *
 * Processa a atualização dos dados da conta do usuário logado.
 */

session_start();
require 'conexao.php';
require 'utils.php'; // CORREÇÃO: Inclui a função a partir do arquivo central.

// --- 1. Validação de Acesso e Método ---
if (!isset($_SESSION['usuario']['id'])) {
    // Redireciona para o login na pasta raiz.
    header("Location: ../../index.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Redireciona para a página da conta na pasta raiz.
    header("Location: ../../conta.php");
    exit;
}

// --- 2. Coleta dos Dados do Formulário ---
$id_usuario_logado = $_SESSION['usuario']['id'];
$novo_nome         = trim($_POST['nome'] ?? '');
$novo_email        = trim($_POST['email'] ?? '');
$nova_senha_plana  = $_POST['senha'] ?? ''; 

if (empty($novo_nome) || empty($novo_email)) {
    exibirMensagem("error", "Erro de Validação", "Nome e e-mail são campos obrigatórios.", "../../conta.php");
}

// --- 3. Construção Dinâmica da Query SQL ---
$partes_da_query = [];
$parametros = [];

$partes_da_query[] = "nome = ?";
$parametros[] = $novo_nome;

$partes_da_query[] = "email = ?";
$parametros[] = $novo_email;

if (!empty($nova_senha_plana)) {
    $hash_da_nova_senha = password_hash($nova_senha_plana, PASSWORD_DEFAULT);
    $partes_da_query[] = "senha = ?";
    $parametros[] = $hash_da_nova_senha;
}

$query_sql = "UPDATE usuarios SET " . implode(", ", $partes_da_query) . " WHERE id = ?";
$parametros[] = $id_usuario_logado;

// --- 4. Execução e Resposta ---
try {
    $declaracao = $pdo->prepare($query_sql);
    $declaracao->execute($parametros);

    // Atualiza os dados na sessão para refletir a mudança imediatamente.
    $_SESSION['usuario']['nome'] = $novo_nome;
    $_SESSION['usuario']['email'] = $novo_email;

    exibirMensagem("success", "Sucesso!", "Seus dados foram atualizados.", "../../conta.php");

} catch (\PDOException $erro) {
    if ($erro->getCode() == 23000) {
        exibirMensagem("error", "E-mail em Uso", "Este endereço de e-mail já pertence a outra conta.", "../../conta.php");
    } else {
        exibirMensagem("error", "Erro no Servidor", "Não foi possível atualizar seus dados.", "../../conta.php");
    }
}

/*
 * A definição da função exibirMensagem() foi REMOVIDA daqui
 * porque agora ela é importada através do 'require "utils.php";'.
 */
?>
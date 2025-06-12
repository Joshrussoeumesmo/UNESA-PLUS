<?php
/**
 * lista_acoes.php
 *
 * Gerencia as ações na "Minha Lista" do usuário.
 * Implementa uma lógica de "toggle": se o filme não está na lista, ele o adiciona.
 * Se o filme já está na lista, ele o remove.
 */

session_start();
header('Content-Type: application/json');
require 'conexao.php'; // Conexão PDO padrão

// --- 1. Validação de Acesso e Dados de Entrada ---

// Garante que apenas usuários logados possam executar esta ação.
if (!isset($_SESSION['usuario']['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Acesso negado: Usuário não autenticado.']);
    exit;
}

// Coleta os dados enviados pelo JavaScript.
$dados_requisicao = json_decode(file_get_contents('php://input'), true);
$id_do_filme      = $dados_requisicao['filme_id'] ?? null;
$id_usuario_logado  = $_SESSION['usuario']['id'];

if (!$id_do_filme) {
    echo json_encode(['status' => 'error', 'message' => 'Erro: O ID do filme não foi fornecido.']);
    exit;
}

// --- 2. Lógica de Toggle (Adicionar/Remover) ---

try {
    // 2.1. Verifica se o filme JÁ EXISTE na lista do usuário.
    $query_verificacao = "SELECT id FROM lista_usuario WHERE usuario_id = ? AND filme_id = ?";
    $declaracao_verificacao = $pdo->prepare($query_verificacao);
    $declaracao_verificacao->execute([$id_usuario_logado, $id_do_filme]);
    
    $item_existe = $declaracao_verificacao->fetch();

    if ($item_existe) {
        // 2.2. SE EXISTE, a ação é REMOVER.
        $query_remocao = "DELETE FROM lista_usuario WHERE usuario_id = ? AND filme_id = ?";
        $declaracao_remocao = $pdo->prepare($query_remocao);
        $declaracao_remocao->execute([$id_usuario_logado, $id_do_filme]);

        echo json_encode(['status' => 'success', 'acao_executada' => 'removido', 'message' => 'Removido da sua lista!']);
    } else {
        // 2.3. SE NÃO EXISTE, a ação é ADICIONAR.
        $query_insercao = "INSERT INTO lista_usuario (usuario_id, filme_id) VALUES (?, ?)";
        $declaracao_insercao = $pdo->prepare($query_insercao);
        $declaracao_insercao->execute([$id_usuario_logado, $id_do_filme]);
        
        echo json_encode(['status' => 'success', 'acao_executada' => 'adicionado', 'message' => 'Adicionado à sua lista!']);
    }

} catch (\PDOException $erro) {
    // ? Em produção, logar o erro: error_log("Erro em lista_acoes.php: " . $erro->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'Ocorreu um erro no servidor ao processar sua solicitação.']);
}
?>
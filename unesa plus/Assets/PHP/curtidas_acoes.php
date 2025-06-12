<?php
/**
 * curtidas_acoes.php
 *
 * Gerencia as ações de "Curtir" e "Não Curtir" de um usuário em um filme.
 * A lógica implementada é de um "toggle" inteligente:
 * 1. Se o usuário clica em "curtir" e não há interação, ele insere um 'like'.
 * 2. Se clica em "curtir" e o filme já está curtido, ele remove a curtida (desfaz a ação).
 * 3. Se clica em "curtir" e o filme estava como "não curtir", ele atualiza para 'like'.
 * O mesmo se aplica para a ação de "não curtir".
 */

session_start();
header('Content-Type: application/json');
require 'conexao.php';

// --- 1. Validação de Acesso e Dados de Entrada ---

if (!isset($_SESSION['usuario']['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Acesso negado: Usuário não autenticado.']);
    exit;
}

$id_usuario_logado = $_SESSION['usuario']['id'];
$dados_requisicao  = json_decode(file_get_contents('php://input'), true);

$id_do_filme  = $dados_requisicao['filme_id'] ?? null;
$tipo_da_acao = $dados_requisicao['tipo'] ?? null; // Espera 'like' ou 'dislike'

// Validação para garantir que os dados necessários foram recebidos e são válidos.
if (!$id_do_filme || !in_array($tipo_da_acao, ['like', 'dislike'])) {
    echo json_encode(['status' => 'error', 'message' => 'Erro: Dados da requisição são inválidos.']);
    exit;
}

// --- 2. Lógica de Interação com o Banco de Dados ---

try {
    // 2.1. Verifica se já existe uma interação (like/dislike) para este filme/usuário.
    $query_verificacao = "SELECT tipo_curtida FROM curtidas_usuario WHERE usuario_id = ? AND filme_id = ?";
    $declaracao_verificacao = $pdo->prepare($query_verificacao);
    $declaracao_verificacao->execute([$id_usuario_logado, $id_do_filme]);
    $curtida_existente = $declaracao_verificacao->fetchColumn(); // Retorna o valor da coluna ou `false`

    if ($curtida_existente) {
        // CASO 1: Já existe uma interação.
        if ($curtida_existente === $tipo_da_acao) {
            // Se a ação do usuário é a MESMA que a já registrada (ex: clicou em 'like' num filme já com 'like'),
            // a ação é desfeita, ou seja, a interação é REMOVIDA.
            $query_remocao = "DELETE FROM curtidas_usuario WHERE usuario_id = ? AND filme_id = ?";
            $declaracao_remocao = $pdo->prepare($query_remocao);
            $declaracao_remocao->execute([$id_usuario_logado, $id_do_filme]);
            echo json_encode(['status' => 'success', 'message' => 'Interação removida.']);
        } else {
            // Se a ação é DIFERENTE (ex: clicou em 'like' num filme com 'dislike'),
            // a interação é ATUALIZADA para o novo tipo.
            $query_atualizacao = "UPDATE curtidas_usuario SET tipo_curtida = ? WHERE usuario_id = ? AND filme_id = ?";
            $declaracao_atualizacao = $pdo->prepare($query_atualizacao);
            $declaracao_atualizacao->execute([$tipo_da_acao, $id_usuario_logado, $id_do_filme]);
            echo json_encode(['status' => 'success', 'message' => 'Interação atualizada.']);
        }
    } else {
        // CASO 2: Nenhuma interação prévia existe.
        // A nova interação é simplesmente INSERIDA no banco.
        $query_insercao = "INSERT INTO curtidas_usuario (usuario_id, filme_id, tipo_curtida) VALUES (?, ?, ?)";
        $declaracao_insercao = $pdo->prepare($query_insercao);
        $declaracao_insercao->execute([$id_usuario_logado, $id_do_filme, $tipo_da_acao]);
        echo json_encode(['status' => 'success', 'message' => 'Interação registrada.']);
    }

} catch (\PDOException $erro) {
    // ? Em produção, logar o erro: error_log("Erro em curtidas_acoes.php: " . $erro->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'Ocorreu um erro no servidor.']);
}
?>
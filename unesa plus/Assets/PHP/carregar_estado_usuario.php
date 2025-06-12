<?php
/**
 * carregar_estado_usuario.php - Busca a "Minha Lista" e as "Curtidas" do usuário.
 */
session_start();
header('Content-Type: application/json');
require 'conexao.php';

$resposta_padrao = ['minhaLista' => [], 'curtidas' => new stdClass()];

if (!isset($_SESSION['usuario']['id'])) {
    echo json_encode($resposta_padrao);
    exit;
}

$id_usuario_logado = $_SESSION['usuario']['id'];
$estado_do_usuario = $resposta_padrao;

try {
    $query_lista = "SELECT filme_id FROM lista_usuario WHERE usuario_id = ?";
    $declaracao_lista = $pdo->prepare($query_lista);
    $declaracao_lista->execute([$id_usuario_logado]);
    $estado_do_usuario['minhaLista'] = $declaracao_lista->fetchAll(PDO::FETCH_COLUMN);

    $query_curtidas = "SELECT filme_id, tipo_curtida FROM curtidas_usuario WHERE usuario_id = ?";
    $declaracao_curtidas = $pdo->prepare($query_curtidas);
    $declaracao_curtidas->execute([$id_usuario_logado]);
    
    $mapa_de_curtidas = new stdClass();
    foreach ($declaracao_curtidas->fetchAll() as $registro_curtida) {
        $mapa_de_curtidas->{$registro_curtida['filme_id']} = $registro_curtida['tipo_curtida'];
    }
    $estado_do_usuario['curtidas'] = $mapa_de_curtidas;
    
    echo json_encode($estado_do_usuario);
} catch (PDOException $erro) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao consultar os dados do usuário.']);
}
?>

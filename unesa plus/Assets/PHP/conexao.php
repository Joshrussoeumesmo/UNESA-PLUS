<?php
/**
 * conexao.php
 * Estabelece a conexão com o banco de dados via PDO.
 * É o coração do acesso a dados do projeto.
 */
$servidor      = 'localhost';
$nome_banco    = 'unesa_plus';
$usuario_banco = 'root';
$senha_banco   = '';
$charset       = 'utf8mb4';

$string_dsn = "mysql:host=$servidor;dbname=$nome_banco;charset=$charset";

$opcoes_pdo = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($string_dsn, $usuario_banco, $senha_banco, $opcoes_pdo);
} catch (\PDOException $erro) {
    throw new \PDOException($erro->getMessage(), (int)$erro->getCode());
}
?>
<?php
session_start();
// Se o usuário não estiver logado, redireciona para a página de login.
if (!isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta - UNESA+</title>

    <link rel="stylesheet" href="Assets/CSS/Main.css">
    <link rel="stylesheet" href="Assets/CSS/Conta.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

    <?php include 'Includes/header_logado.php'; ?>

    <main class="account-container">
        <h1>Gerenciar Conta</h1>
        
        <?php if(isset($_GET['status'])): ?>
            <?php if($_GET['status'] == 'success'): ?>
                <div class="alert success">Dados atualizados com sucesso!</div>
            <?php elseif($_GET['status'] == 'error'): ?>
                <div class="alert error">Ocorreu um erro ao atualizar os dados. Tente novamente.</div>
            <?php endif; ?>
        <?php endif; ?>

        <form action="Assets/PHP/atualizar_conta.php" method="POST" class="account-form">
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($_SESSION['usuario']['nome']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['usuario']['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="senha">Nova Senha (deixe em branco para não alterar)</label>
                <input type="password" id="senha" name="senha">
            </div>
            <button type="submit" class="btn-submit">Salvar Alterações</button>
        </form>
        </main>
    <?php include 'Includes/footer.php'; ?>

</body>
</html>
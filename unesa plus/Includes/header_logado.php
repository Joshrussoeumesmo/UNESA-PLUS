<?php
/**
 * Includes/header_logado.php
 * * Este arquivo renderiza o cabeçalho padrão para todas as páginas
 * quando o usuário está autenticado no sistema.
 * Ele exibe uma mensagem de boas-vindas personalizada e o menu de navegação.
 */
?>
<header class="main-header">
    <div class="header-container">

        <div class="header-left">
            <a href="home.php" class="logo-link" title="Voltar ao Início">
                <img src="Assets/Imagens/Logos/logo.png" alt="Logotipo UNESA+">
            </a>
            <nav class="main-nav">
                <a href="home.php" class="active">Início</a>
                <a href="manutencao.php">Séries</a>
                <a href="manutencao.php">Filmes</a>
                <a href="manutencao.php">Minha Lista</a>
            </nav>
        </div>
        
        <div class="header-right">

            <div class="welcome-message"> 
                Olá, <?php echo htmlspecialchars(explode(' ', $_SESSION['usuario']['nome'])[0]); ?>!
            </div>

            <div class="dropdown profile-menu">
                <a href="#" class="profile-button" role="button" aria-expanded="false" title="Menu do perfil">
                    <i class="fa-solid fa-star profile-icon"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-start">
                    <li>
                        <a class="dropdown-item" href="manutencao.php">
                            <i class="fa-solid fa-child fa-fw"></i> Infantil
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="conta.php">
                            <i class="fa-solid fa-user-gear fa-fw"></i> Conta
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="Assets/PHP/sair.php">
                            <i class="fa-solid fa-arrow-right-from-bracket fa-fw"></i> Sair
                        </a>
                    </li>
                </ul>
            </div>
            
        </div>

    </div>
</header>
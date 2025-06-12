<?php
    // Inicia a sessão para que o header_logado.php possa exibir o nome do usuário.
    session_start();
    // Se o usuário não estiver logado, ele ainda pode ver a página da equipe,
    // mas o header não mostraria a saudação. Pode-se adicionar um redirect se preferir.
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nossa Equipe - UNESA+</title>

    <link rel="stylesheet" href="Assets/CSS/Main.css"> <link rel="stylesheet" href="Assets/CSS/Equipe.css"> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

    <?php 
        // Verifica se o usuário está logado para decidir qual header incluir.
        if (isset($_SESSION['usuario'])) {
            include 'Includes/header_logado.php';
        } else {
            // ? Futuramente, podemos criar um 'header_deslogado.php' para este caso.
            // Por enquanto, o header atual serve bem.
            include 'Includes/header_logado.php'; 
        }
    ?>

    <main class="team-container">
        <h1>Nossa Equipe de Desenvolvedores</h1>
        <p class="subtitle">Os arquitetos por trás da sua experiência no UNESA+</p>
        
        <div class="team-grid">
            
            <div class="team-member">
                <img src="Assets/Imagens/Equipe/foto-ericson.jpg" alt="Foto de Ericson Fernandes">
                <h2>Ericson Fernandes Figueiredo</h2>
                <h3>Desenvolvedor Full-Stack</h3>
                <p>Responsável pela arquitetura do backend com PHP e pela dinâmica do frontend com JavaScript.</p>
                <div class="social-links">
                    <a href="https://www.linkedin.com/in/ericson-fernandes-29a911252/" target="_blank" title="LinkedIn de Ericson"><i class="fab fa-linkedin"></i></a>
                    <a href="https://github.com/EricsonFer?tab=repositories" target="_blank" title="GitHub de Ericson"><i class="fab fa-github"></i></a>
                </div>
            </div>
            
            <div class="team-member">
                <img src="Assets/Imagens/Equipe/foto-josh.jpeg" alt="Foto de Josh V. Russo">
                <h2>Josh V. Russo</h2>
                <h3>Desenvolvedor Full-Stack</h3>
                <p>Estudante de Sistemas de Informação | Futuro Desenvolvedor Full Stack | Buscando Estágio em TI.</p>
                <div class="social-links">
                    <a href="https://www.linkedin.com/in/josh-russo-/" target="_blank" title="LinkedIn de Josh"><i class="fab fa-linkedin"></i></a>
                    <a href="https://github.com/Joshrussoeumesmo" target="_blank" title="GitHub de Josh"><i class="fab fa-github"></i></a>
                </div>
            </div>

            </div>
        </main>
    <?php include 'Includes/footer.php'; ?>

</body>
</html>
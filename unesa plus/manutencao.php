<?php
    // Inicia a sessão para que o header_logado.php, se usado, funcione corretamente.
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Em Construção - UNESA+</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Assets/CSS/Main.css"> <link rel="stylesheet" href="Assets/CSS/Manutencao.css"> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet">
</head>
<body>

    <?php include 'Includes/header_logado.php'; ?>

    <main class="restricted-container">
        <div class="restricted-content">
            
            <h1><i class="fa-solid fa-person-digging"></i> Área em Desenvolvimento <i class="fa-solid fa-person-digging"></i></h1>
            
            <div class="text-container">
                <p class="typing-effect">Nossos desenvolvedores estão compilando o futuro desta página...</p>
            </div>
            
            <div class="progress-bar-container">
                <div class="progress-bar"></div>
            </div>

            <p class="redirect-message">Redirecionando automaticamente em <span id="countdown">10</span> segundos...</p>
            
            <a href="home.php" class="btn-back">Voltar Agora</a>
        </div>
    </main>

    <?php include 'Includes/footer.php'; ?>

    <script>
        /**
         * Script para a contagem regressiva e redirecionamento automático.
         * Este script é específico para esta página.
         */
        document.addEventListener('DOMContentLoaded', (evento) => {
            let elementoContador = document.getElementById('countdown');
            let segundosRestantes = 10;

            const intervalo = setInterval(() => {
                segundosRestantes--;
                if (elementoContador) {
                    elementoContador.textContent = segundosRestantes;
                }
                if (segundosRestantes <= 0) {
                    clearInterval(intervalo);
                    window.location.href = 'home.php';
                }
            }, 1000);
        });
    </script>
</body>
</html>
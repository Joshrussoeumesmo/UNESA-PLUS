<?php
session_start();
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
    <title>Início - UNESA+</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="Assets/CSS/Main.css">
</head>
<body>
    
    <div class="modal fade" id="movieModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="modal-hero" id="modalHero">
                        <div class="modal-hero-buttons" id="modalButtonsContainer">
                            </div>
                    </div>
                    <div class="modal-info-wrapper">
                        <div class="modal-info-left">
                            <div class="d-flex align-items-center gap-3 mb-2">
                                <span class="relevance" id="modalRelevance"></span>
                                <span class="year" id="modalYear"></span>
                                <span class="duration" id="modalDuration"></span>
                                <span class="rating" id="modalRating"></span>
                            </div>
                            <p class="sinopse" id="modalSinopse"></p>
                        </div>
                        <div class="modal-info-right">
                            <p><span class="label">Elenco:</span> <span id="modalCast"></span></p>
                            <p><span class="label">Gêneros:</span> <span id="modalGenres"></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'Includes/header_logado.php'; ?>

    <main>
        <div class="owl-carousel owl-theme hero-carousel">
            <div class="hero hero-1" data-movie-id="51">
                <div class="hero-content">
                    <img class="hero-title-img" src="Assets/Imagens/Logos/vingadores-ultimato-title.png" alt="Vingadores: Ultimato"/>
                    <p class="top-badge"><i class="fa-solid fa-trophy"></i> Top 1 de hoje no Brasil</p>
                    <p class="hero-description">Com o universo em ruínas, os Vingadores restantes enfrentam Thanos...</p>
                    <div class="hero-buttons">
                        <a href="manutencao.php" class="btn-hero btn-play"><i class="fa-solid fa-play"></i> Assistir</a>
                        <button class="btn-hero btn-info btn-toggle-lista"><i class="fa-solid fa-plus"></i> Adicionar à lista</button>
                    </div>
                </div>
            </div>
            <div class="hero hero-2" data-movie-id="21">
                <div class="hero-content">
                    <img class="hero-title-img" src="Assets/Imagens/Logos/logo-poderoso-chefao.png" alt="O Poderoso Chefão"/>
                    <p class="hero-description">O patriarca de uma dinastia do crime transfere o controle de seu império...</p>
                     <div class="hero-buttons">
                        <a href="manutencao.php" class="btn-hero btn-play"><i class="fa-solid fa-play"></i> Assistir</a>
                        <button class="btn-hero btn-info btn-toggle-lista"><i class="fa-solid fa-plus"></i> Adicionar à lista</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="carousel-wrapper">
            <div id="container-minha-lista"></div>
            <div id="container-top-10"></div>
            <div id="container-acao"></div>
            <div id="container-drama"></div>
            <div id="container-comedia"></div>
        </div>
    </main>

    <?php include 'Includes/footer.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="Assets/JS/data.js"></script> 
    <script src="Assets/JS/main.js"></script>
</body>
</html>
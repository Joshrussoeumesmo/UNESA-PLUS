// Arquivo: Assets/JS/main.js (VERSÃO FINAL CORRIGIDA E COMPLETA)
$(document).ready(function() {

    // Objeto que armazena os dados do usuário (Minha Lista e Curtidas) após o carregamento.
    let estadoUsuario = { minhaLista: [], curtidas: {} };

    // ===================================================================
    // FUNÇÕES "FÁBRICA" PARA CRIAR HTML DINAMICAMENTE
    // ===================================================================

    function criarCardDoFilme(idDoFilme) {
        const dadosDoFilme = dadosFilmes[idDoFilme]; 
        if (!dadosDoFilme) return '';

        const estaNaMinhaLista = estadoUsuario.minhaLista.includes(idDoFilme.toString());
        const tipoDeCurtida = estadoUsuario.curtidas[idDoFilme];
        
        const classeBotaoLike = (tipoDeCurtida === 'like') ? 'active' : '';
        const iconeBotaoLike = (tipoDeCurtida === 'like') ? 'fa-solid' : 'fa-regular';
        const classeBotaoDislike = (tipoDeCurtida === 'dislike') ? 'active' : '';
        const iconeBotaoDislike = (tipoDeCurtida === 'dislike') ? 'fa-solid' : 'fa-regular';
        
        const htmlBotaoLista = `<a href="#" class="btn-bar-action btn-toggle-lista ${estaNaMinhaLista ? 'active' : ''}" data-movie-id="${idDoFilme}" title="${estaNaMinhaLista ? 'Remover da lista' : 'Adicionar à lista'}"><i class="fa-solid ${estaNaMinhaLista ? 'fa-check' : 'fa-plus'}"></i></a>`;

        return `
            <div class="item" data-movie-id="${idDoFilme}">
                <img class="box-filme" src="${dadosDoFilme.poster}" alt="${dadosDoFilme.title}">
                <div class="info-bar">
                    <div class="buttons-bar">
                        <a href="manutencao.php" class="btn-bar-action btn-play"><i class="fa-solid fa-play"></i></a>
                        <a href="#" class="btn-bar-action btn-like ${classeBotaoLike}" data-movie-id="${idDoFilme}"><i class="fa-thumbs-up ${iconeBotaoLike}"></i></a>
                        <a href="#" class="btn-bar-action btn-dislike ${classeBotaoDislike}" data-movie-id="${idDoFilme}"><i class="fa-thumbs-down ${iconeBotaoDislike}"></i></a>
                        ${htmlBotaoLista}
                    </div>
                    <a href="#" class="btn-bar-action btn-modal-trigger"><i class="fa-solid fa-chevron-down"></i></a>
                </div>
            </div>`;
    }

    function renderizarCarrosselDeCategoria(titulo, seletorContainer, idsDosFilmes) {
        const container = $(seletorContainer);
        if (!container.length) return;
        let htmlDosItems = '';
        idsDosFilmes.forEach(id => { htmlDosItems += criarCardDoFilme(id); });
        const temFilmesVisiveis = idsDosFilmes.length > 0 && !(idsDosFilmes.length === 1 && idsDosFilmes[0] === '0');
        const htmlDoTitulo = temFilmesVisiveis ? `<h3 class="carousel-title">${titulo}</h3>` : '';
        if (container.find('.owl-carousel').hasClass('owl-loaded')) {
            container.find('.owl-carousel').trigger('destroy.owl.carousel');
        }
        container.html(`<section class="carousel-section">${htmlDoTitulo}<div class="owl-carousel owl-theme">${htmlDosItems}</div></section>`);
        if (htmlDosItems) {
            container.find('.owl-carousel').owlCarousel({
                loop: false, margin: 15, nav: true, dots: false,
                navText: ['<div class="nav-btn prev-slide"><i class="fa-solid fa-chevron-left"></i></div>','<div class="nav-btn next-slide"><i class="fa-solid fa-chevron-right"></i></div>'],
                responsive: { 0:{items:3}, 600:{items:4}, 1000:{items:6} }
            });
        }
    }

    function atualizarBotoesDoBanner() {
        $('.hero').each(function() {
            const banner = $(this);
            const idDoFilme = banner.data('movie-id');
            if (!idDoFilme) return;
            const estaNaMinhaLista = estadoUsuario.minhaLista.includes(idDoFilme.toString());
            const botao = banner.find('.btn-info');
            botao.removeClass('btn-add-lista btn-remove-lista').addClass('btn-toggle-lista');
            if (estaNaMinhaLista) {
                botao.html('<i class="fa-solid fa-check"></i> Na sua lista');
            } else {
                botao.html('<i class="fa-solid fa-plus"></i> Adicionar à lista');
            }
        });
    }

    // ===================================================================
    // LÓGICA PRINCIPAL DE CARREGAMENTO DA PÁGINA
    // ===================================================================
    function inicializarPagina() {
        fetch('Assets/PHP/carregar_estado_usuario.php') 
            .then(resposta => resposta.json())
            .then(dados => {
                estadoUsuario = dados;
                const idsMinhaLista = estadoUsuario.minhaLista.length > 0 ? estadoUsuario.minhaLista : ['0'];
                const idsTop10 = [51, 26, 21, 1, 22, 5, 8, 40, 23, 30];
                const idsAcao = [1, 2, 3, 4, 5, 7, 8, 9, 10, 51];
                const idsDrama = [21, 22, 23, 24, 25, 26, 27, 28, 29, 30];
                const idsComedia = [11, 12, 13, 14, 15, 16, 17, 18, 19, 20];
                renderizarCarrosselDeCategoria("Minha Lista", "#container-minha-lista", idsMinhaLista);
                renderizarCarrosselDeCategoria("Top 10 no Brasil", "#container-top-10", idsTop10);
                renderizarCarrosselDeCategoria("Ação", "#container-acao", idsAcao);
                renderizarCarrosselDeCategoria("Drama", "#container-drama", idsDrama);
                renderizarCarrosselDeCategoria("Comédia", "#container-comedia", idsComedia);
                atualizarBotoesDoBanner();
            })
            .catch(erro => console.error("Erro fatal ao carregar o estado do usuário:", erro));
    }

    inicializarPagina();
    
    // ===================================================================
    // INICIALIZAÇÕES E EVENTOS DE UI (INTERFACE DO USUÁRIO)
    // ===================================================================
    const corpoDocumento = $(document);
    $('.hero-carousel').owlCarousel({ items: 1, loop: true, nav: false, dots: true, autoplay: true, autoplayTimeout: 7000, autoplayHoverPause: true, animateOut: 'fadeOut' });

    // --- Ações de Curtir e Lista (com delegação de evento) ---
    corpoDocumento.on('click', '.btn-like, .btn-dislike', function(evento) {
        evento.preventDefault(); evento.stopPropagation();
        const botaoClicado = $(this);
        const idDoFilme = botaoClicado.data('movie-id');
        const tipoAcao = botaoClicado.hasClass('btn-like') ? 'like' : 'dislike';
        fetch('Assets/PHP/curtidas_acoes.php', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ filme_id: idDoFilme, tipo: tipoAcao }), })
        .then(resposta => resposta.json())
        .then(dados => { if (dados.status === 'success') { inicializarPagina(); } else { Swal.fire({ icon: 'error', title: 'Erro', text: dados.message, background: '#181818', color: '#fff' }); } });
    });

    corpoDocumento.on('click', '.btn-toggle-lista', function(evento) {
        evento.preventDefault(); evento.stopPropagation();
        const idDoFilme = $(this).data('movie-id') || $(this).closest('.item, .hero').data('movie-id');
        if (!idDoFilme && idDoFilme !== 0) return;
        fetch('Assets/PHP/lista_acoes.php', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ filme_id: idDoFilme }), })
        .then(resposta => resposta.json())
        .then(dados => { if (dados.status === 'success') { inicializarPagina(); } else { Swal.fire({ icon: 'error', title: 'Erro', text: dados.message, background: '#181818', color: '#fff' }); } });
    });

    // --- Lógica do Modal ---
    const modalFilme = new bootstrap.Modal(document.getElementById('movieModal'));
    
    function abrirModal(elementoClicado) {
        const idDoFilme = $(elementoClicado).closest('.item, .hero').data('movie-id');
        if (idDoFilme === 0 || !idDoFilme) return;
        const dadosDoFilme = dadosFilmes[idDoFilme]; // Usa a variável correta
        if (dadosDoFilme) {
            $('#modalHero').css('background-image', `linear-gradient(to top, #181818 10%, transparent 50%), url(${dadosDoFilme.cover})`);
            $('#modalRelevance').text(dadosDoFilme.relevance);
            $('#modalYear').text(dadosDoFilme.year);
            $('#modalDuration').text(dadosDoFilme.duration);
            $('#modalSinopse').text(dadosDoFilme.sinopse);
            $('#modalCast').text(dadosDoFilme.cast);
            $('#modalGenres').text(dadosDoFilme.genres);
            const estaNaMinhaLista = estadoUsuario.minhaLista.includes(idDoFilme.toString());
            const htmlBotaoLista = `<a href="#" class="btn-bar-action btn-toggle-lista ${estaNaMinhaLista ? 'active' : ''}" data-movie-id="${idDoFilme}" title="${estaNaMinhaLista ? 'Remover da lista' : 'Adicionar à lista'}"><i class="fa-solid ${estaNaMinhaLista ? 'fa-check' : 'fa-plus'}"></i></a>`;
            const tipoDeCurtida = estadoUsuario.curtidas[idDoFilme];
            const classeBotaoLike = (tipoDeCurtida === 'like') ? 'active' : '';
            const iconeBotaoLike = (tipoDeCurtida === 'like') ? 'fa-solid' : 'fa-regular';
            const classeBotaoDislike = (tipoDeCurtida === 'dislike') ? 'active' : '';
            const iconeBotaoDislike = (tipoDeCurtida === 'dislike') ? 'fa-solid' : 'fa-regular';
            const htmlDosBotoesDoModal = `
                <a href="manutencao.php" class="btn-hero btn-play"><i class="fa-solid fa-play"></i> Assistir</a>
                <div class="modal-actions-right">
                    <a href="#" class="btn-bar-action btn-like ${classeBotaoLike}" data-movie-id="${idDoFilme}"><i class="fa-thumbs-up ${iconeBotaoLike}"></i></a>
                    <a href="#" class="btn-bar-action btn-dislike ${classeBotaoDislike}" data-movie-id="${idDoFilme}"><i class="fa-thumbs-down ${iconeBotaoDislike}"></i></a>
                    ${htmlBotaoLista}
                </div>`;
            $('#modalButtonsContainer').html(htmlDosBotoesDoModal);
            modalFilme.show();
        }
    }

    corpoDocumento.on('click', '.item, .hero', function(evento) {
        if (!$(evento.target).closest('.btn-hero, .btn-bar-action').length) { abrirModal(this); }
    });
    corpoDocumento.on('click', '.btn-modal-trigger', function(evento){
        evento.preventDefault(); evento.stopPropagation();
        abrirModal(this);
    });

    // --- Outros Eventos ---
    $('.profile-menu').hover( function() { $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(200); }, function() { $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(200); });
    $(window).on('scroll', () => $('.main-header').toggleClass('scrolled', $(window).scrollTop() > 50));
});
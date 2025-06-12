<?php
/**
 * utils.php
 * Contém funções auxiliares reutilizáveis para o projeto.
 */

/**
 * Exibe uma mensagem (sucesso ou erro) com SweetAlert e redireciona o usuário.
 *
 * @param string $icone 'success', 'error', 'warning', 'info'.
 * @param string $titulo O título do alerta.
 * @param string $texto O corpo da mensagem do alerta.
 * @param string $url_redirecionamento A página para onde o usuário será enviado.
 */
function exibirMensagem($icone, $titulo, $texto, $url_redirecionamento) {
    echo <<<HTML
        <!DOCTYPE html>
        <html lang="pt-br"><head><meta charset="UTF-8">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <title>Aviso - UNESA+</title></head><body style="background-color: #141414;">
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: '{$icone}',
                    title: '{$titulo}',
                    text: '{$texto}',
                    background: '#141414',
                    color: '#fff',
                    confirmButtonColor: '#e50914',
                    confirmButtonText: 'Ok'
                }).then(() => {
                    window.location.href = '{$url_redirecionamento}';
                });
            });
        </script></body></html>
    HTML;
    exit();
}
?>
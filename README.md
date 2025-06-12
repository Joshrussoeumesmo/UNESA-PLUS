# UNESA+ - Plataforma de Streaming Fictícia

![Badge](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![Badge](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![Badge](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![Badge](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Badge](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

## 📖 Descrição Resumida

**UNESA+** é um projeto acadêmico desenvolvido para a matéria de Programação para Web do 5º período do curso de Sistemas de Informação. Trata-se de uma simulação de uma plataforma de streaming de filmes e séries, inspirada em serviços como a Netflix. O objetivo principal foi aplicar de forma integrada os conceitos fundamentais de desenvolvimento web, desde a estruturação do frontend com HTML, CSS e JavaScript, até a criação de um backend dinâmico com PHP e a persistência de dados em um banco de dados MySQL.

---

## 🎥 Demonstração

*É altamente recomendado adicionar aqui um GIF ou um vídeo curto mostrando a aplicação em funcionamento. Ferramentas como ScreenToGif (Windows) ou Kap (Mac) podem ser usadas para gravar a tela.*

![Prévia do Projeto](https://placehold.co/800x450/141414/e50914?text=Insira+um+GIF+da+Aplicação+Aqui)

---

## ✨ Recursos e Funcionalidades Principais

* **Sistema de Autenticação Completo:**
    * [x] **Cadastro de Usuários:** Com validação de dados e criptografia de senha segura (`password_hash`).
    * [x] **Login de Usuários:** Com verificação de credenciais e criação de sessões (`$_SESSION`).
    * [x] **Logout Seguro:** Funcionalidade para destruir a sessão do usuário.
* **Interface Dinâmica e Personalizada:**
    * [x] **Homepage Protegida:** Acessível apenas para usuários autenticados.
    * [x] **Saudação Personalizada:** O cabeçalho exibe o primeiro nome do usuário logado.
    * [x] **Renderização Dinâmica:** Os carrosséis de filmes são gerados via JavaScript a partir de um "banco de dados" de filmes.
* **Interatividade com o Usuário:**
    * [x] **Sistema de "Minha Lista":** O usuário pode adicionar e remover filmes de uma lista pessoal, com os dados salvos no banco de dados.
    * [x] **Sistema de "Curtir/Não Curtir":** O usuário pode registrar suas preferências, que são salvas no banco de dados.
    * [x] **Consistência de Estado:** Os botões (adicionar à lista, curtir) refletem o estado atual do filme em toda a interface e são atualizados em tempo real após uma ação.
* **Páginas Adicionais:**
    * [x] **Página de Conta:** Permite ao usuário visualizar e atualizar seus dados cadastrais (nome, e-mail e senha).
    * [x] **Página de Equipe:** Apresenta os desenvolvedores do projeto.
    * [x] **Página de Manutenção:** Um placeholder elegante para seções em desenvolvimento.

---

## 🛠️ Tecnologias Utilizadas

* **Frontend:**
    * HTML5
    * CSS3 (com Flexbox para layout)
    * JavaScript (ES6+)
* **Backend:**
    * PHP 8+
* **Banco de Dados:**
    * MySQL
* **Bibliotecas JavaScript:**
    * [jQuery](https://jquery.com/) - Para manipulação do DOM e eventos.
    * [Owl Carousel 2](https://owlcarousel2.github.io/OwlCarousel2/) - Para os carrosséis de filmes.
    * [Bootstrap 5](https://getbootstrap.com/) - Para o sistema de modal.
    * [SweetAlert2](https://sweetalert2.github.io/) - Para notificações e alertas amigáveis.
* **Ambiente de Desenvolvimento:**
    * Servidor Apache (via XAMPP/WAMP/MAMP)
    * phpMyAdmin para gerenciamento do banco de dados.

---

## ⚙️ Pré-requisitos para Executar

Antes de começar, você precisará ter instalado em sua máquina um ambiente de servidor local que suporte PHP e MySQL.

* [XAMPP](https://www.apachefriends.org/pt_br/index.html) (recomendado) ou um ambiente similar (WAMP, MAMP, LAMP).
* Um navegador web moderno (Chrome, Firefox, Edge).

---

## 🚀 Instalação e Execução

Siga os passos abaixo para rodar o projeto localmente:

1.  **Clone o repositório:**
    ```bash
    git clone [https://github.com/seu-usuario/unesa-plus.git](https://github.com/seu-usuario/unesa-plus.git)
    ```

2.  **Mova a pasta do projeto:**
    * Copie a pasta `unesa-plus` para o diretório `htdocs` da sua instalação do XAMPP (geralmente em `C:/xampp/htdocs/`).

3.  **Inicie os serviços:**
    * Abra o painel de controle do XAMPP e inicie os módulos **Apache** e **MySQL**.

4.  **Crie e importe o Banco de Dados:**
    * Abra seu navegador e acesse `http://localhost/phpmyadmin/`.
    * Crie um novo banco de dados chamado **`unesa_plus`**.
    * Selecione o banco recém-criado e vá para a aba "Importar".
    * Importe o arquivo `database.sql` (você precisará criar este arquivo exportando a estrutura e os dados do seu banco de dados final).

5.  **Acesse a aplicação:**
    * Abra seu navegador e acesse: **`http://localhost/unesa-plus/`**.

A página de login será exibida e você poderá se cadastrar e utilizar a plataforma.

---

## 📁 Estrutura de Pastas

A estrutura do projeto foi organizada para separar as responsabilidades:

```
/unesa-plus/
|
|-- Assets/
|   |-- CSS/         (Todos os arquivos de estilo)
|   |-- JS/          (Scripts de frontend: data.js, main.js)
|   |-- Imagens/     (Logos, banners, capas, etc.)
|
|-- Includes/        (Componentes reutilizáveis como header e footer)
|
|-- PHP/             (Toda a lógica de backend)
|
|-- index.html       (Página inicial/login)
|-- cadastro.html
|-- home.php         (Página principal da plataforma)
|-- conta.php
|-- equipe.php
|-- manutencao.php
|-- ... (outros arquivos .php)
```

---

## ✍️ Autores

Projeto desenvolvido com dedicação por:

* **Ericson Fernandes Figueiredo** - [LinkedIn](https://www.linkedin.com/in/ericson-fernandes-29a911252/) | [GitHub](https://github.com/EricsonFer)
* **Josh V. Russo** - [LinkedIn](https://www.linkedin.com/in/josh-russo-/) | [GitHub](https://github.com/Joshrussoeumesmo)

---

## 📜 Licença

Este projeto é um trabalho acadêmico e não possui uma licença formal para distribuição ou uso comercial. Todo o conteúdo é para fins educacionais.

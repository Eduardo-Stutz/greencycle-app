<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- Define o tipo do documento como HTML5 e utiliza o método Laravel para definir a linguagem com base na configuração do app. -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Permite que o título da página seja definido dinamicamente em diferentes layouts ou views. -->

    <!-- Adiciona um ícone para a aba do navegador. -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <script src="/js/scripts.js"></script>

    <!-- Adiciona o arquivo CSS principal da aplicação. -->
    <link rel="stylesheet" href="/css/styles2.css">
    
    <!-- Adiciona o CSS do framework Bootstrap para estilização padrão. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Inclui fontes do Google para estilização textual. -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <!-- Inclui a biblioteca Font Awesome para ícones. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<body>
    <header>
        <!-- Contêiner principal do cabeçalho. -->
        <div class="container">
            <!-- Imagem de fundo representando lixo eletrônico. -->
            <img src="https://statustech.com.br/artigos/2024/02/000000010/imagens/principal_65d0d0165a422.webp"
                alt="Background image showing electronic waste including old monitors and other electronic devices"
                class="background-image">
            <div class="overlay">
                <!-- Logo da aplicação. -->
                <div class="logo">
                <img src="/img/GreenCycle.svg" alt="logo">
                </div>
            </div>
        </div>
        <div class="nav">
            <!-- Links principais de navegação. -->
            <a href="https://greencycle.site" class="button">Portal GreenCycle</a>    
            <a href="/" class="button">Produtos</a>
            <a href="/products/create" class="button">Anunciar produtos</a>
            
            @auth
            <!-- Links disponíveis somente para usuários autenticados. -->
                <a href="/dashboard" class="button">Meus Produtos</a>
                <img style="margin-top:7px" src="{{ asset('img/perfil.png') }}" alt="Imagem de perfil" class="profile-icon">
                <span style="margin-top:7px" class="profile-name">
                    <span style="color:#56AB2F">Usuário: </span>{{ Auth::user()->name }}
                </span>  
                <li>  
                <!-- Formulário para logout com prevenção do evento de clique padrão. -->
                <form action="/logout" method="POST">
                        @csrf
                        <a id="" href="/logout" class="button-sair" onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            <ion-icon name="exit-outline"></ion-icon> Sair
                        </a>
                    </form>
                </li>
            @endauth

            @guest
            <!-- Links disponíveis somente para usuários não autenticados. -->
                <a href="/login" class="button-login"><ion-icon name="log-out-outline"></ion-icon> Entrar</a>
                <a href="/register" class="button-login"><ion-icon name="person-add-outline"></ion-icon> Cadastrar</a>
            @endguest
        </div>
    </header>
    <main>
        <!-- Área principal da página. -->
        <div class="container-fluid">
            <div class="row">
                <!-- Exibe mensagens de sessão, se existirem. -->
                @if(session('msg'))
                    <p class="msg">{{ session('msg') }}</p>
                @endif
                <!-- Inclui o conteúdo dinâmico de diferentes views. -->
                @yield('content')
            </div>
        </div>
    </main>
    <footer>
        <!-- Rodapé da página com informações de contato e links sociais. -->
        <div class="footer">
            <div class="logo">
                <img alt="GreenCycle logo" 
                    src="https://greencycle.site/wp-content/uploads/2024/10/2.png"/>
            </div>
            <div class="contact-info">
                <p>Av. Jorge Amado, S/N, Jd. Limoeiro, Camaçari-BA.</p>
                <p>CEP: 42800-605.</p>
            </div>
            <div class="social-icons">
                <!-- Links para redes sociais e contato. -->
                <a href="https://www.instagram.com/greencycle.ba/">
                    <i class="fab fa-instagram"></i>
                    SIGA-NOS NO INSTAGRAM
                </a>
                <a href="#">
                    <i class="fab fa-whatsapp"></i>
                    FALE CONOSCO PELO WHATSAPP
                </a>
                <a href="#">
                    <i class="fas fa-envelope"></i>
                    FALE CONOSCO PELO E-MAIL
                </a>
            </div>
        </div>
    </footer>
    <!-- Scripts para ícones Ionicons. -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
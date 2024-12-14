<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <!-- icon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <!-- scripts -->
    <script src="/js/scripts.js"></script>
    <!-- CSS da aplicação -->
    <link rel="stylesheet" href="/css/styles2.css">
    <script src="/js/scripts.js"></script>
    <!-- CSS bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Fontes do Google -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<body>
    <header>
        <div class="container">
            <img src="https://statustech.com.br/artigos/2024/02/000000010/imagens/principal_65d0d0165a422.webp"
                alt="Background image showing electronic waste including old monitors and other electronic devices"
                class="background-image">
            <div class="overlay">
                <div class="logo">
                <img src="/img/GreenCycle.svg" alt="logo">
                </div>
            </div>
        </div>
        </div>
        <div class="nav">
            <a href="https://greencycle.site" class="button">Portal GreenCycle</a>    
            <a href="/" class="button">Produtos</a>
            <a href="/products/create" class="button">Cadastrar produto</a>
            @auth
                <a href="/dashboard" class="button">Meus Produtos</a>
                <li>
                    <form action="/logout" method="POST">
                        @csrf
                        <a href="/logout" class="button" onclick="event.preventDefault();
                                            this.closest('form').submit();"> Sair</a>
                    </form>
                </li>
            @endauth
            @guest
                <a href="/login" class="button">Entrar</a>
                <a href="/register" class="button">Cadastrar</a>
            @endguest
    </header>
    <main>
        <div class="container-fluid">
            <div class="row">
                @if(session('msg'))
                    <p class="msg">{{session('msg')}}</p>
                @endif
                @yield ('content')
            </div>
        </div>
    </main>
    <footer>
        <div class="footer">
            <div class="logo">
                <img alt="GreenCycle logo" 
                    src="https://greencycle.site/wp-content/uploads/2024/10/2.png"/>
            </div>
            <div class="contact-info">
                <p>
                    Av. Jorge Amado, S/N, Jd. Limoeiro, Camaçari-BA.
                </p>
                <p>
                    CEP: 42800-605.
                </p>
            </div>
            <div class="social-icons">
                <a href="https://www.instagram.com/greencycle.ba/">
                    <i class="fab fa-instagram">
                    </i>
                    SIGA-NOS NO INSTAGRAM
                </a>
                <a href="#">
                    <i class="fab fa-whatsapp">
                    </i>
                    FALE CONOSCO PELO WHATSAPP
                </a>
                <a href="#">
                    <i class="fas fa-envelope">
                    </i>
                    FALE CONOSCO PELO E-MAIL
                </a>
            </div>
        </div>
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
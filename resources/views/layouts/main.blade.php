<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <script src="/js/scripts.js"></script>
        <!-- CSS da aplicação -->
        <link rel="stylesheet" href="/css/styles.css">
        <script src="/js/scripts.js"></script>
        <!-- CSS bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- Fontes do Google -->
        <link rel="stylesheet" href="https://fonts.googleapis.com">
    </head>
    
    <body>
    <header>
        <hr>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class= "collapse navbar-collapse" id="navbar">
               <a href="/" class="navbar-brand">
                <img src="/img/hdcevents_logo.svg" alt="logo">
               </a> 
               <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/" class="nav-link">Produtos</a>
                </li>
                <li class="nav-item">
                    <a href="/products/create" class="nav-link">Cadastrar produto</a>
                </li>
                @auth
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link">Meus Produtos</a>
                </li>
                <li> <form action="/logout" method="POST">
                        @csrf
                        <a href="/logout" 
                        class="nav-link" 
                        onclick= "event.preventDefault();
                        this.closest('form').submit();"> Sair</a>
                    </form>
                </li>
                @endauth
                @guest
                <li class="nav-item">
                    <a href="/login" class="nav-link">Entrar</a>
                </li>
                <li class="nav-item">
                    <a href="/register" class="nav-link">Cadastrar</a>
                </li>
                @endguest
               </ul>
            </div>
        </nav>
        <hr>
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
    <footer>Greencycle &copy; 2024</footer>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </body>

</html>

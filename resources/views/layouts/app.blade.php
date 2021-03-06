<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GDA</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel{{ isset($compact) ? ' d-none d-lg-block' : ''}}">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    Grand Débat &middot; Annotations
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>
                    @auth
                        <span class="badge badge-pill badge-{{ \Illuminate\Support\Facades\Auth::user()->badgeColor() }}" style="font-size: 14px;">
                            {{ \Illuminate\Support\Facades\Auth::user()->scores['total'] }}
                        </span>&nbsp;
                        @include('users.badge', ['user' => \Illuminate\Support\Facades\Auth::user()])
                    @endauth
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Inscription</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/account">
                                        Mon compte
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Se déconnecter
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        @yield('content')

                        <div class="{{ isset($compact) ? 'd-none d-sm-block' : ''}}">
                            <div class="d-flex justify-content-center mt-3">
                                <a href="/faq">FAQ</a>
                                <span class="ml-3 mr-3"> &middot; </span>
                                <a href="/data">Données ouvertes</a>
                                <span class="ml-3 mr-3"> &middot; </span>
                                <a href="https://github.com/fm89/granddebat">Dépôt GitHub</a>
                                <span class="ml-3 mr-3"> &middot; </span>
                                <a href="/legal">Mentions légales</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>

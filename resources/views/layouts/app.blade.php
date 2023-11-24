<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])

    <style>
        body {
            background-color: #000;
            color: #fff;
        }
        @php
            $routes = ['login', 'register'];
        @endphp

        @if(in_array(Route::currentRouteName(),$routes))
        body{
            background-image: url("https://i.etsystatic.com/17653747/r/il/315985/3092801421/il_1588xN.3092801421_1hr5.jpg");
        }

        body::before {
            content: "";
            background-color: rgba(0, 0, 0, 0.8);
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: -1;
        }

        .card{
            color: white;
            background-color: #141414;
            opacity: 0.9;
            padding: 3rem;
        }

        .form .row{
            justify-content: center;
        }
        @endif

        .netflix-btn {
            background-color: #e50914;
            border-color: #e50914;
            font-weight: bold;
        }

        .netflix-btn:hover {
            background-color: #b70510;
            border-color: #b70510;
        }

        .bg-dark {
            background-color: #141414 !important;
        }

        .custom-nav{
            opacity: 0.6;
        }

        .bi-person-fill{
            font-size: xx-large;
        }

        .centered-logo {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

    </style>

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top custom-nav">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="/logo" alt="Logo" style="width: 200px;">
            </a>

                @auth
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav w-100 align-items-center">
                        @if(Route::currentRouteName() ==='index')
                        <li class="nav-item">
                            <a class="nav-link" href="#Action">Action</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#Adventure">Adventure</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#Puzzle">Puzzle</a>
                        </li>
                        @endif
                        <li class="nav-item dropdown ms-auto">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Hello, {{ Auth::user()->name }} <i class="bi bi-person-fill"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                <li><a class="dropdown-item" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Log Out <i class="bi bi-box-arrow-right"></i></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                @endauth
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
</div>

@if(!in_array(Route::currentRouteName(),$routes))
<div id="logo-screen">
    <img src="/logo" class="centered-logo" alt="logo">
</div>

<audio id="myAudio">
    <source src="/game/welcomeAudio" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    $('#app').addClass('d-none');
    $("#logo-screen").fadeIn(1000);

    window.onload = ()=>{
        $("#logo-screen").fadeOut(3500, ()=>{
            $('#app').removeClass('d-none');
            const audio = document.getElementById('myAudio');
            audio.play();
        });
    }
</script>

@endif
</body>
</html>

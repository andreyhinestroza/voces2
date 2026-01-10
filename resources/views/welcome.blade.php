<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>VOCES | Plataforma de Concursos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark px-4">
        <a class="navbar-brand" href="/">VOCES</a>
        <div class="ms-auto">
            @if(Auth::check())
                <img src="{{ Auth::user()->foto }}" width="32" class="rounded-circle me-2">
                <span class="text-white me-3">{{ Auth::user()->nombre }}</span>
                <a href="{{ route('logout') }}" class="btn btn-outline-light btn-sm">Cerrar sesión</a>
            @else
                <a href="{{ route('google.login') }}" class="btn btn-outline-light d-flex align-items-center">
                    <img src="{{ asset('img/logogoogle.png') }}" width="32" class="me-2 rounded-circle bg-white p-1">
                    Iniciar sesión con Google
                </a>
            @endif
        </div>
    </nav>

    <main class="container mt-5">
        @if(Auth::check())
            <h2 class="text-center mb-4">Bienvenido, {{ Auth::user()->nombre }}</h2>
            <p class="text-center">Explora concursos activos, sube tus videos y vota por tus favoritos.</p>

            {{-- Aquí puedes mostrar concursos activos --}}
            <div class="row">
                <div class="col-md-6">
                    <h4>Concursos activos</h4>
                    {{-- Aquí iría un loop con concursos desde el controlador --}}
                </div>
                <div class="col-md-6">
                    <h4>Mis videos</h4>
                    {{-- Aquí iría un loop con videos del usuario --}}
                </div>
            </div>
        @else
            <div class="text-center">
                <h2>Bienvenido a VOCES</h2>
                <p>Inicia sesión con Google para participar en concursos, subir videos y votar.</p>
                <a href="{{ route('google.login') }}" class="btn btn-primary d-flex align-items-center justify-content-center mx-auto" style="width: 250px;">
                    <img src="{{ asset('img/logogoogle.png') }}" width="32" class="me-2 rounded-circle bg-white p-1">
                    Iniciar sesión con Google
                </a>
            </div>
        @endif
    </main>

</body>
</html>

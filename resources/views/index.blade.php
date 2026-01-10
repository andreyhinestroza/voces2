<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Las Voces de Mi Pueblo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Icono y estilos -->
<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
    
    .videos-recientes-btn {
    display: block;
    width: 100%; /* ocupa todo el ancho */
    background-color: var(--bs-primary); /* verde institucional */
    color: #fff; /* letras blancas */
    font-size: 1.5rem;
    font-weight: bold;
    text-align: center;
    padding: 1rem;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.videos-recientes-btn i {
    color: #fff; /* icono blanco */
    font-size: 1.6rem;
}

    .explora-generos-btn {
    display: block;
    width: 100%; /* ocupa todo el ancho */
    background-color: var(--bs-primary); /* verde institucional */
    color: #fff; /* letras blancas */
    font-size: 1.5rem;
    font-weight: bold;
    text-align: center;
    padding: 1rem;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .explora-generos-btn i {
        color: #fff; /* icono blanco */
        font-size: 1.6rem;
    }

    .card-credencial {
    background-color: #fff;
    border-radius: 16px;
    padding: 2rem 1.5rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    }

    .card-credencial:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.15);
    }

    .card-credencial h3 {
        font-weight: bold;
        margin-top: 1rem;
        margin-bottom: 0.75rem;
    }

    .card-credencial p {
        font-size: 0.95rem;
        color: #333;
        margin-bottom: 1rem;
    }
 
    body {
    background-image: url('{{ asset('img/fondoindex.png') }}');
    background-size: cover;              /* Ocupa toda la pantalla */
    background-attachment: fixed;        /* Fondo fijo al hacer scroll */
    background-position: center center;  /* Centrado horizontal y vertical */
    background-repeat: no-repeat;
    background-color: #f8f9fa;           /* Color institucional claro de respaldo */
    }

        .btn-google {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.6rem 1.2rem;
    border: 2px solid #fff;
    color: #fff;
    background-color: var(--bs-primary);
    font-weight: bold;
    border-radius: 8px;
    animation: glow-border 1.5s infinite alternate;
    white-space: nowrap;
    box-shadow: 0 0 10px rgba(255,255,255,0.3);
    transition: all 0.3s ease-in-out;
    margin-left: 1.5rem;   /* separa del botón anterior */
    margin-top: 0.25rem;   /* ajusta altura vertical */
    }

    .btn-google img {
        margin-right: 0.5rem;
        width: 24px;
        height: 24px;
        object-fit: cover;
    }

    @keyframes glow-border {
        from {
            border-color: #fff;
            box-shadow: 0 0 5px #fff, 0 0 10px #fff;
        }
        to {
            border-color: var(--bs-warning);
            box-shadow: 0 0 15px var(--bs-warning), 0 0 30px var(--bs-warning);
        }
    }


        :root {
            --bs-primary: #1E484B;     /* Verde institucional principal */
            --bs-secondary: #00A06E;   /* Verde complementario */
            --bs-success: #f8f9fa;     /* Fondo claro */
            --bs-info: #d6e9c6;        /* Puedes ajustar si usas info */
            --bs-warning: #FAC00B;     /* Amarillo institucional */
            --bs-danger: #bc6c25;      /* Puedes mantenerlo si aplica */
            --bs-light: #f8f9fa;       /* Fondo claro */
            --bs-dark: #000000;        /* Negro institucional */
        }
        /*body {
            padding-top: 70px; //Ajusta según la altura real del navbar 
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }*/
        .navbar-brand, .card-title, .btn {
            font-weight: bold;
        }
        .navbar-brand {
            font-size: 1.8rem; /* Marca principal más grande */
        }
        .nav-link {
            font-size: 1.2rem; /* Enlaces del menú más legibles */
        }
        .btn-outline-light {
            font-size: 1.1rem; /* Botón de Google más visible */
        }
        .hero {
            height: 70vh;
            overflow: hidden;
             margin-top: 80px; /* Ajusta según la altura del navbar */
        }
        .navbar.fixed-top {
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }

        .slide-bg {
            background-size: cover;
            background-position: center;
            height: 70vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .overlay {
            background-color: rgba(40, 54, 24, 0.6); /* Verde institucional semitransparente */
            color: white;
            text-align: center;
            padding: 2rem;
            width: 100%;
        }
        .feature-icon {
            font-size: 2.5rem;
            color: var(--bs-primary);
            margin-bottom: 1rem;
        }
        .genre-card {
            transition: transform 0.3s;
            height: 100%;
        }
        .genre-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .video-thumbnail {
            height: 200px;
            object-fit: cover;
        }
        footer {
            background-color: var(--bs-primary);
            color: white;
            padding: 2rem 0;
            margin-top: 2rem;
        }
        .social-icon {
            font-size: 1.5rem;
            margin: 0 0.5rem;
            color: white;
        }
        .btn-primary {
            background-color: var(--bs-primary);
            border-color: var(--bs-primary);
        }
        .btn-primary:hover {
            background-color: var(--bs-secondary);
            border-color: var(--bs-secondary);
        }
        .carousel-item {
            transition: transform 1s ease, opacity 1s ease;
        }
        .overlay h1, .overlay p, .overlay .btn {
            animation: fadeInUp 1s ease forwards;
            opacity: 0;
        }
        .carousel-item.active .overlay h1 {
            animation-delay: 0.3s;
        }
        .carousel-item.active .overlay p {
            animation-delay: 0.6s;
        }
        .carousel-item.active .overlay .btn {
            animation-delay: 0.9s;
        }
        @keyframes fadeInUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        .animated-text {
            opacity: 0;
            transform: translateY(100px); /* más abajo aún */
            transition: all 0.8s ease;    /* más lento */
        }
        .carousel-item.active .animated-text.animate {
            opacity: 1;
            transform: translateY(0);
        }
        .carousel-item.active h1.animated-text {
            transition-delay: 0.2s;
        }
        .carousel-item.active p.animated-text {
            transition-delay: 0.4s;
        }
        .carousel-item.active .btn.animated-text {
            transition-delay: 0.6s;
        }
        img {
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }
        /* Estilos para el contenido adicional */
        .section-title {
            font-size: 2rem;
            margin-bottom: 2rem;
            color: var(--bs-primary);
            text-align: center;
        }
        .content-section {
            padding: 3rem 0;
        }
        .genre-card .card-body {
            display: flex;
            flex-direction: column;
        }
        .genre-card .btn {
            margin-top: auto;
        }
        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }
        .video-card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .video-card:hover {
            transform: translateY(-5px);
        }
        .video-card .card-img-top {
            height: 180px;
            object-fit: cover;
        }
        .video-card .card-body {
            padding: 1rem;
        }
        .video-card .card-title {
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }
        .video-card .card-text {
            font-size: 0.85rem;
            color: #6c757d;
        }


        .user-link {
        color: white; /* texto normal */
        cursor: pointer; /* manito normal */
        }

        .user-link:hover {
            color: red; /* nombre se pone rojo */
        }

        .user-link:hover img {
            border: 2px solid red; /* borde rojo en la foto */
        }


  

    </style>
</head>
<body>
   <!-- 🔝 Barra de navegación fija -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: var(--bs-primary);">
    
    <div class="container">
        <div class="d-flex align-items-center">
            <!-- Logo institucional en el extremo izquierdo -->
            <a href="#" class="me-3">
                <img src="{{ asset('img/Logoicono.png') }}" alt="Logo Alcaldía"
                    style="height: 40px; width: auto;">
            </a>

            <!-- Marca del sitio -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <i class="fas fa-microphone-alt me-2"></i>
                <span>Las Voces de Mi Pueblo</span>
            </a>
        </div>



        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Menú principal con iconos -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                        <i class="fas fa-home me-1"></i> Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('comunidad.todos') }}">
                        <i class="fas fa-music me-1"></i> Géneros
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ranking.index') }}">
                        <i class="fas fa-star me-1"></i> Ranking
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('comunidad') }}">
                        <i class="fas fa-users me-1"></i> Concursos
                    </a>
                </li>

            </ul>

            <!-- Bloque de usuario separado -->
           @auth
                <a href="{{ url('perfil') }}" class="user-link d-flex align-items-center text-decoration-none ms-5">
                    @if(Auth::user()->foto)
                        <img src="{{ Auth::user()->foto }}"
                            alt="Foto"
                            class="rounded-circle bg-white p-1 me-2"
                            width="32" height="32"
                            style="object-fit: cover;"
                            onerror="this.onerror=null;this.src='{{ asset('img/avatar-default.png') }}';">
                    @else
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-2"
                            style="width: 32px; height: 32px;">
                            {{ strtoupper(substr(Auth::user()->nombre, 0, 1)) }}
                        </div>
                    @endif
                    <span class="fw-bold">{{ Auth::user()->nombre }}</span>
                </a>
            @endauth


            @guest
                <a href="{{ route('auth.google') }}" class="btn btn-google">
    <img src="{{ asset('img/logogoogle.png') }}" class="rounded-circle bg-white p-1" alt="Google">
    Iniciar sesión con Google
</a>




            @endguest

            @auth
                <a href="{{ route('logout') }}" class="btn btn-sm btn-outline-light d-flex align-items-center ms-3">
                    <i class="fas fa-sign-out-alt me-2"></i> Cerrar sesión
                </a>
        @endauth



        </div>
    </div>
</nav>

    </div>
</nav>


    <!-- 🎤 Slider principal -->
    <section class="hero text-center p-0 m-0">
        <div id="sliderHero" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="slide-bg" style="background-image: url('{{ asset('img/100.jpg') }}');">
                        <div class="overlay">
                            <h1 class="display-4 fw-bold animated-text">
                                Celebra el Talento de Candelaria
                            </h1>
                            <p class="lead animated-text">
                                Participa, vota y descubre las increíbles voces de nuestra comunidad
                            </p>
                            <div class="mt-4">
                                <button class="btn btn-warning btn-lg me-2 animated-text">Participar</button>
                                <button class="btn btn-outline-light btn-lg animated-text">Ver Rankings</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="slide-bg" style="background-image: url('{{ asset('img/101.jpg') }}');">
                        <div class="overlay">
                            <h1 class="display-4 fw-bold animated-text">
                                Expresa tu voz, comparte tu historia
                            </h1>
                            <p class="lead animated-text">
                                Un espacio para el arte, la cultura y la inclusión
                            </p>
                            <div class="mt-4">
                                <button class="btn btn-warning btn-lg me-2 animated-text">Participar</button>
                                <button class="btn btn-outline-light btn-lg animated-text">Ver Rankings</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="slide-bg" style="background-image: url('img/102.jpeg');">
                        <div class="overlay">
                            <h1 class="display-4 fw-bold animated-text">
                                Las Voces de Mi Pueblo
                            </h1>
                            <p class="lead animated-text">
                                Una plataforma para el talento local
                            </p>
                            <div class="mt-4">
                                <button class="btn btn-warning btn-lg me-2 animated-text">Participar</button>
                                <button class="btn btn-outline-light btn-lg animated-text">Ver Rankings</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="slide-bg" style="background-image: url('img/103.jpeg');">
                        <div class="overlay">
                            <h1 class="display-4 fw-bold animated-text">
                                Candelaria canta con identidad
                            </h1>
                            <p class="lead animated-text">
                                Apoya a tus artistas favoritos
                            </p>
                            <div class="mt-4">
                                <button class="btn btn-warning btn-lg me-2 animated-text">Participar</button>
                                <button class="btn btn-outline-light btn-lg animated-text">Ver Rankings</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#sliderHero" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#sliderHero" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#sliderHero" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#sliderHero" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#sliderHero" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#sliderHero" data-bs-slide-to="3" aria-label="Slide 4"></button>
            </div>
        </div>
    </section>

<section class="container my-5">
    <div class="row text-center align-items-stretch">
        <!-- Bloque: Sube tu Video -->
        <div class="col-md-4 mb-4">
            <div class="card-credencial h-100 d-flex flex-column justify-content-between">
                <div>
                    <i class="fa-solid fa-video fa-4x mb-3 text-success"></i>
                    <h3 class="text-success">Sube tu Video</h3>
                    <p>Sube un video ya grabado mostrando tu talento vocal, copiando el enlace de YouTube en nuestra plataforma.</p>
                </div>
                <div class="mt-auto">
                    @auth
                        @if(Auth::user()->rol === 'participante')
                            <a href="javascript:void(0)" class="btn btn-lg btn-outline-success custom-btn" data-bs-toggle="modal" data-bs-target="#subirVideoModal">
                                Subir Video
                            </a>
                        @else
                            <a href="javascript:void(0)" class="btn btn-lg btn-outline-success custom-btn" data-bs-toggle="modal" data-bs-target="#convertirseModal">
                                Subir Video
                            </a>
                        @endif
                    @else
                        <a href="{{ route('auth.google') }}" class="btn btn-lg btn-outline-success custom-btn" title="Inicia sesión para subir video">
                            Subir Video
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Bloque: Comunidad Activa -->
        <div class="col-md-4 mb-4">
            <div class="card-credencial h-100 d-flex flex-column justify-content-between">
                <div>
                    <i class="fa-solid fa-users fa-4x mb-3 text-warning"></i>
                    <h3 class="text-warning">Comunidad Activa</h3>
                    <p>Conecta con otros artistas locales, vota por tus favoritos y comenta en sus presentaciones.</p>
                </div>
                <div class="mt-auto">
                    <a href="{{ route('comunidad') }}" class="btn btn-lg btn-outline-warning custom-btn">
                        Ir a la Comunidad
                    </a>
                </div>
            </div>
        </div>

        <!-- Bloque: Clasificación por Género -->
        <div class="col-md-4 mb-4">
            <div class="card-credencial h-100 d-flex flex-column justify-content-between text-center">
                <div>
                    <i class="fa-solid fa-music fa-4x mb-3" style="color: #1E484B;"></i>
                    <h3 class="mt-3" style="color: #1E484B;">Clasificación por Género</h3>
                    <p>Participa en categorías como salsa, pop, folclor y más, celebrando nuestra diversidad musical.</p>
                </div>
                <div class="mt-auto">
                    <a href="{{ route('comunidad.todos') }}" class="btn btn-lg custom-btn"
                    style="border: 2px solid #1E484B; color: #1E484B;">
                        Ver Clasificación
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>





   <!-- 📢 Sección de participación con fondo blanco -->
<section class="container my-5 bg-white p-4 rounded shadow-sm">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h2 class="fw-bold" style="color: var(--bs-primary);">¿Listo para mostrar tu talento?</h2>
            <p>Únete a nuestra comunidad de artistas candelarios. Sube tu video, participa en concursos y conecta con tu pueblo.</p>
            <a href="{{ route('auth.google') }}" class="btn btn-primary btn-lg px-4 py-2 mt-3" style="display: inline-flex; align-items: center; gap: 0.5rem;">
                <img src="{{ asset('img/logogoogle.png') }}" alt="Google" class="rounded-circle bg-white p-1" style="width: 28px; height: 28px;">
                Regístrate con Google
            </a>
       </div>
        <div class="col-md-6 text-center">
            <img src="{{ asset('img/logo.jpeg') }}" alt="Alcaldía" class="img-fluid w-75" style="box-shadow: none;">
        </div>
    </div>
</section>



<!-- 🎶 Sección: Explora por Géneros -->
<div class="container mt-5">
    <div class="explora-generos-btn text-center mb-4">
    <i class="fas fa-music me-2"></i> Explora por Géneros
    </div>

        
    <div class="row">
        @foreach($generoVideos as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0" style="border-radius: 8px;">
                    <div class="card-body">
                        <h5 class="card-title text-center" style="color: #34495E;">
                            {{ ucfirst($item['genero']) }}
                        </h5>
                        <p class="card-text text-center text-muted">
                           Explora lo mejor de nuestros género {{ ucfirst($item['genero']) }} en nuestra comunidad Candelareña.
                        </p>

                        @if($item['video'])
                            <div class="ratio ratio-16x9 mb-3">
                                <iframe id="player-{{ $item['video']->id }}"
                                src="{{ $item['video']->embed_url }}"
                                frameborder="0" allowfullscreen></iframe>
                            </div>
                        @else
                            <div class="alert alert-warning text-center">
                                No hay videos disponibles para este género.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Botón para ver todos los géneros -->
    <!-- Botón Ver Todos los Géneros -->
        <div class="text-center mt-4">
            <a href="{{ route('comunidad.todos') }}" class="btn btn-primary">
                Ver Todos los Géneros
            </a>
        </div>
</div>


<!-- 🆕 Sección: Videos Recientes -->
<div class="container mt-5">
    <div class="videos-recientes-btn text-center mb-4">
    <i class="fas fa-clock me-2"></i> Videos Recientes
    </div>


    <div class="row">
        @foreach($videosRecientes as $video)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title">{{ $video->titulo }}</h5>
                        <p class="card-text"><strong>Artista:</strong> {{ $video->usuario->nombre }}</p>
                        <p class="card-text"><strong>Género:</strong> {{ ucfirst($video->genero) }}</p>

                        <div class="ratio ratio-16x9">
                            <iframe id="player-recientes-{{ $video->id }}"
                                    src="{{ $video->embed_url }}"
                                    frameborder="0" allowfullscreen></iframe>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>

            <div class="text-center mt-4">
                <a href="#" class="btn btn-primary">Ver Más Videos</a>
            </div>

</div>



    <!-- 📎 Pie de página -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>Las Voces de Mi Pueblo</h5>
                    <p>Plataforma cultural que fortalece la identidad de Candelaria y promueve el talento local.</p>
                </div>
                <div class="col-md-2 mb-4">
                    <h5 class="text-uppercase text-[#FAC00B] font-bold mb-3">Enlaces</h5>
                    <ul class="list-unstyled space-y-2">
                        <li>
                            <a href="{{ url('/') }}" class="text-white hover:text-[#FAC00B] transition">
                                <i class="fas fa-home me-1"></i> Inicio
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('comunidad.todos') }}" class="text-white hover:text-[#FAC00B] transition">
                                <i class="fas fa-music me-1"></i> Géneros
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('ranking.index') }}" class="text-white hover:text-[#FAC00B] transition">
                                <i class="fas fa-star me-1"></i> Ranking
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('comunidad') }}" class="text-white hover:text-[#FAC00B] transition">
                                <i class="fas fa-users me-1"></i> Concursos
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-3 mb-4">
                    <h5>Contacto</h5>
                    <address class="text-white">
                        <strong>Alcaldía de Candelaria</strong><br>
                        Plaza Central, Candelaria<br>
                        Valle del Cauca<br>
                        Tel: (34) 922 123 456
                    </address>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Newsletter</h5>
                    <p>Suscríbete para recibir noticias y actualizaciones.</p>
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Tu email">
                        <button class="btn btn-primary" type="button">Suscribir</button>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('sliderHero');
            if (carousel) {
                const bsCarousel = new bootstrap.Carousel(carousel, {
                    interval: 4000,
                    wrap: true
                });
            }
        });
    </script>

        // 🎥 YouTube IFrame API para control de reproducción
        <script src="https://www.youtube.com/iframe_api"></script>
        <script>
            let players = [];

            function onYouTubeIframeAPIReady() {
                const iframes = document.querySelectorAll("iframe[id^='player-']");
                iframes.forEach(iframe => {
                    const player = new YT.Player(iframe.id, {
                        events: { 'onStateChange': onPlayerStateChange }
                    });
                    players.push(player);
                });
                console.log("Players inicializados:", players.length);
            }

            function onPlayerStateChange(event) {
                if (event.data === YT.PlayerState.PLAYING) {
                    players.forEach(p => {
                        if (p !== event.target) {
                            p.pauseVideo(); // ✅ pausa los demás
                        }
                    });
                }
            }
        </script>

</body>
</html>



<!-- Modal Subir Video -->
<div class="modal fade" id="subirVideoModal" tabindex="-1" aria-labelledby="subirVideoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      
      <!-- Encabezado verde -->
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="subirVideoModalLabel">Subir Video</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      
      <!-- Cuerpo -->
      <div class="modal-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('video.store') }}" method="POST">
            @csrf
            
            <!-- Título -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título del Video</label>
                <input type="text" name="titulo" id="titulo" class="form-control" required>
            </div>
            
            <!-- URL de YouTube -->
            <div class="mb-3">
                <label for="url_video" class="form-label">Enlace de YouTube</label>
                <input type="url" name="url_video" id="url_video" class="form-control" placeholder="https://www.youtube.com/watch?v=..." required>
            </div>
            
            <!-- Género Musical -->
            <div class="mb-3">
                <label for="genero" class="form-label">Género Musical</label>
                <select name="genero" id="genero" class="form-select" required>
                    <option value="salsa">Salsa</option>
                    <option value="pop">Pop</option>
                    <option value="rock">Rock</option>
                    <option value="folclor">Folclor</option>
                    <option value="vallenato">Vallenato</option>
                    <option value="ranchera">Ranchera</option>
                    <option value="otro">Otro</option>
                </select>
            </div>
            
            <!-- Concurso -->
            <div class="mb-3">
                <label for="id_concurso" class="form-label">Concurso</label>
                <select name="id_concurso" id="id_concurso" class="form-select">
                    <option value="" selected>Ninguno</option>
                    @forelse($concursos as $concurso)
                        <option value="{{ $concurso->id }}">{{ $concurso->nombre }}</option>
                    @empty
                        <option disabled>No hay concursos activos</option>
                    @endforelse
                </select>
            </div>

            
            <!-- Botón -->
            <button type="submit" class="btn btn-success">Publicar Video</button>
        </form>
      </div>
    </div>
  </div>
</div>




<!-- Modal: Convertirse en Participante -->
<div class="modal fade" id="convertirseModal" tabindex="-1" aria-labelledby="convertirseModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      
      <!-- Encabezado verde -->
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="convertirseModalLabel">Convertirse en Participante</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      
      <!-- Cuerpo -->
      <div class="modal-body">
        <p>Para subir videos debes ser participante. ¿Quieres cambiar tu rol ahora y unirte a la comunidad de artistas?</p>
      </div>
      
      <!-- Pie -->
      <div class="modal-footer">
        <form action="{{ route('convertirse.participante.store') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Sí, convertirme en participante</button>
        </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
      
    </div>
  </div>
</div>


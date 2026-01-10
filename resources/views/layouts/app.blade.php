<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Las Voces de Mi Pueblo</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
   <style>
        .btn-google {
    border: 2px solid #fff;
    color: #fff;
    background-color: var(--bs-primary);
    width: 100%; /* ocupa todo el ancho */
    font-weight: bold;
    text-align: center;
    padding: 0.8rem;
    border-radius: 8px;
    animation: glow-border 1.5s infinite alternate; /* animación constante */
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
        body {
             background-color: var(--bs-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        
            padding-top: 70px; /* Ajusta según la altura real del navbar */           
        }

        .navbar {
            background-color: var(--bs-primary);
        }

        
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


        .notification-box {
    background-color: var(--bs-primary); /* Verde-azul institucional */
    color: #fff;                         /* Texto blanco */
    border-radius: 12px;                 /* Bordes redondeados */
    padding: 1rem 1.5rem;
    margin-top: 1.5rem;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15); /* Sombra ligera */
}

.notification-box h6 {
    font-weight: bold;
    margin-bottom: 0.75rem;
}

.notification-box ul {
    list-style: none;
    padding-left: 0;
    margin: 0;
}

.notification-box li {
    margin-bottom: 0.5rem;
    padding-left: 1.2rem;
    position: relative;
}

.notification-box li::before {
    content: "•";
    color: var(--bs-warning); /* Amarillo institucional */
    position: absolute;
    left: 0;
}


.concurso-box {
    background-color: var(--bs-primary); /* Verde-azul institucional */
    color: #fff;                         /* Texto blanco */
    border-radius: 12px;                 /* Bordes redondeados */
    padding: 1rem 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15); /* Sombra ligera */
}

.concurso-box .concurso-title {
    color: var(--bs-warning); /* Amarillo institucional solo para el título */
    font-weight: bold;
    margin-bottom: 0.75rem;
}

.concurso-box p {
    margin-bottom: 0.4rem;
}






    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
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
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="{{ url('/') }}"><i class="fas fa-home me-1"></i> Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('comunidad.todos') }}"><i class="fas fa-music me-1"></i> Géneros</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('ranking.index') }}">Ranking</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('comunidad') }}"><i class="fas fa-users me-1"></i> Concursos
    </a>
</li>

                </ul>

                @auth
                    <a href="{{ route('perfil') }}" class="user-link d-flex align-items-center text-decoration-none ms-5">
                        <img src="{{ Auth::user()->foto }}" alt="Foto" class="rounded-circle bg-white p-1 me-2" width="32" height="32" style="object-fit: cover;">
                        <span class="fw-bold text-white">{{ Auth::user()->nombre }}</span>
                    </a>
                    <a href="{{ route('logout') }}" class="btn btn-sm btn-outline-light d-flex align-items-center ms-3">
                        <i class="fas fa-sign-out-alt me-2"></i> Cerrar sesión
                    </a>
                @endauth

                @guest
                    <a href="{{ route('auth.google') }}" class="btn btn-outline-light d-flex align-items-center ms-5">
                        <img src="{{ asset('img/logogoogle.png') }}" class="me-2 rounded-circle bg-white p-1" alt="Google" width="24" height="24">
                        Iniciar sesión con Google
                    </a>
                @endguest
            </div>
        </div>
    </nav>

    @yield('content')

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

    @yield('scripts')
</body>
</html>

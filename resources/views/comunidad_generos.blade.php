@extends('layouts.app')

@section('content')

    <body class="comunidad-generos">
        <div class="container mt-4">
            {{-- Título institucional como botón visual --}}
            <div class="text-center mb-5">
                <div class="d-inline-block px-4 py-2 rounded-pill shadow-lg"
                    style="background-color: #00a06dbb; color: white; font-family: 'Montserrat', sans-serif; font-weight: 700; font-size: 1.6rem; letter-spacing: 1px;">
                    🎶 Todos los Géneros Musicales
                </div>
            </div>

            @foreach($generoVideos as $bloque)
                <div class="card mb-5 shadow-lg"
                    style="background-color: rgba(255, 255, 255, 0.47); color: #000000; font-family: 'Montserrat', sans-serif;">

                    {{-- Encabezado del género --}}
                    <div class="card-header text-center"
                        style="background-color: #1E484B; color: white; font-weight: 600; font-size: 1.3rem;">
                        {{ ucfirst($bloque['genero']) }}
                    </div>

                    {{-- Contenedor con scroll vertical si hay más de 3 videos --}}
                    <div class="card-body genre-videos">
                        <div class="row">
                            @foreach($bloque['videos'] as $video)
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100 shadow-sm video-card"
                                        style="transition: transform 0.3s ease, box-shadow: 0 6px 10px -2px rgba(0, 0, 0, 0.7);">
                                        <div class="card-body">
                                            <h6 class="card-title" style="color: #00A06E; font-weight: 600;">{{ $video->titulo }}
                                            </h6>
                                            <p class="card-text mb-2"><strong>Artista:</strong> {{ $video->usuario->nombre }}</p>

                                            <div class="ratio ratio-16x9" style="height: 140px; overflow: hidden;">
                                                <iframe id="player-{{ $video->id }}" src="{{ $video->embed_url }}?enablejsapi=1"
                                                    frameborder="0" allowfullscreen></iframe>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
@endsection

    @section('scripts')
        {{-- Tipografía Montserrat --}}
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

        {{-- Estilos embebidos --}}
        <style>
            /* Fondo musical solo para esta página */
            body.comunidad-generos {
                background-image: url('{{ asset('img/fondo-musical.png') }}');
                background-size: 300px 300px;
                /* tamaño del patrón repetitivo */
                background-repeat: repeat;
                /* se repite en mosaico */
                background-attachment: fixed;
                /* fijo al hacer scroll */
                background-position: center;
            }

            /* Ajuste para que el contenido resalte sobre el fondo */
            .card {
                background-color: rgba(255, 255, 255, 0.06);
                border: none;
            }

            /* Contenedor de videos con scroll vertical */
            .genre-videos {
                max-height: 600px;
                overflow-y: auto;
                overflow-x: hidden;
                padding-right: 10px;

            }

            /* Scroll estilizado en gris */
            .genre-videos::-webkit-scrollbar {
                width: 10px;
            }

            .genre-videos::-webkit-scrollbar-thumb {
                background-color: #888;
                border-radius: 10px;
            }

            .genre-videos::-webkit-scrollbar-thumb:hover {
                background-color: #555;
            }

            .genre-videos::-webkit-scrollbar-track {
                background-color: #f1f1f1;
            }

            /* Hover solo para tarjetas de video */
            .video-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
            }



            /* Tarjeta individual de video oscura */
            .video-card {
                background-color: rgba(255, 255, 255, 0.9);
                color: #ffffff;
                /* texto blanco para contraste */
                border-radius: 8px;
                box-shadow: 0 2px 10px rgb(0, 0, 0);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
        </style>

        {{-- YouTube API para control de reproducción --}}
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
                            p.pauseVideo();
                        }
                    });
                }
            }
        </script>
    @endsection
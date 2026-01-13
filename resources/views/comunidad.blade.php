@extends('layouts.app')

@section('content')

<head>
    <style>
        .btn-sm {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            border-radius: 8px;
            padding: 6px 12px;
            transition: all 0.2s ease;
        }

        .btn-outline-primary:hover {
            background-color: #1E484B;
            color: #ffffff;
            border-color: #1E484B;
        }

        .btn-outline-success:hover {
            background-color: #00A06E;
            color: #ffffff;
            border-color: #00A06E;
        }

        .btn-outline-secondary:hover {
            background-color: #FAC00B;
            color: #000000;
            border-color: #FAC00B;
        }

    </style>
</head>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar izquierda -->
        <div class="col-md-3 bg-light border-end" style="height: 100vh; overflow-y: auto;">
            <h5 class="mt-3 ms-3">🎧 Artistas Suscritos</h5>
            <ul class="list-group list-group-flush">
                @foreach($artistas as $artista)
                    <li class="list-group-item">
                        <i class="fas fa-user me-2"></i>{{ $artista->nombre }}
                    </li>
                @endforeach
            </ul>

            <hr class="my-3">

            <!-- Opciones del usuario -->
            <h6 class="ms-3">👤 Mi cuenta</h6>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><i class="fas fa-history me-2"></i> Historial</li>
                <li class="list-group-item"><i class="fas fa-list me-2"></i> Lista de reproducción</li>
                <li class="list-group-item"><i class="fas fa-thumbs-up me-2"></i> Videos que me gustan</li>

                @auth
                    @if(Auth::user()->rol === 'participante')
                        <li class="list-group-item"><i class="fas fa-video me-2"></i> Mis videos</li>
                    @elseif(Auth::user()->rol === 'espectador')
                        <li class="list-group-item"><i class="fas fa-eye me-2"></i> Mis favoritos</li>
                    @endif
                @else
                    <li class="list-group-item text-center">
                        <a href="{{ route('auth.google') }}" class="btn btn-outline-primary w-100">
                            Inicia sesión con Google
                        </a>
                    </li>
                @endauth
            </ul>
        </div>

        <!-- Contenido principal -->
        <div class="col-md-9">

            <!-- Propaganda horizontal -->
            <div class="mb-4 text-center">
                <img src="{{ asset('img/propaganda.png') }}" alt="Publicidad Alcaldía"
                     class="img-fluid w-100" 
                     style="box-shadow: 0 0 20px rgba(0,0,0,0.3); border-radius: 0;">
            </div>

            <!-- Título centrado -->
            <h2 class="text-center mt-3" style="color: #1E484B;">🎤 Comunidad Activa</h2>
            <!-- Nuevo título Concursos -->
            <h2 class="mt-5 mb-4" style="color: #000000; font-weight: bold;">Concursos</h2>
            <div class="concursos-buttons d-flex flex-wrap mb-3">
                @foreach($concursos as $i => $concurso)
                    @php
                        $activo = $concurso->estado === 'activo' && $concurso->activo == 1;
                    @endphp
                    <button
                        type="button"
                        class="btn me-2 mb-2 {{ $activo ? 'btn-outline-primary' : 'btn-secondary disabled' }} concurso-btn {{ $i === 0 && $activo ? 'active' : '' }}"
                        {{ $activo ? "onclick=mostrarRanking('$concurso->id', this)" : 'disabled' }}>
                        {{ $concurso->nombre }}
                    </button>
                @endforeach
            </div>


            @foreach($videosPorConcurso as $id => $videos)
                <div class="ranking-concurso {{ $loop->first ? 'active' : '' }}" id="ranking-{{ $id }}">
                    <div class="row">
                        @forelse($videos as $video)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm"
                                    @if(!empty($video->embed_url))
                                        onclick="openModal('{{ $video->embed_url }}', '{{ $video->titulo }}', '{{ $video->usuario->nombre }}')"
                                    @endif>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $video->titulo }}</h5>
                                        <p class="card-text"><strong>Género:</strong> {{ $video->genero }}</p>
                                        <p class="card-text"><strong>Artista:</strong> {{ $video->usuario->nombre }}</p>

                                        <div class="ratio ratio-16x9">
                                            <iframe id="player-{{ $video->id }}" src="{{ $video->embed_url }}" frameborder="0" allowfullscreen></iframe>
                                        </div>

                                        <!-- Acciones debajo del video -->
                                        <div class="mt-3 d-flex justify-content-center gap-2">
                                            <button class="btn btn-sm btn-outline-primary">👍 Me gusta</button>
                                            <button class="btn btn-sm btn-outline-success">🗳️ Votar</button>
                                            <button class="btn btn-sm btn-outline-secondary">💬 Comentar</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info text-center">
                                    No hay videos disponibles en este momento.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach


<!-- SDK de Facebook -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v18.0">
</script>
@endsection

<!-- API de YouTube para reproducir videos -->
@section('scripts')
<script src="https://www.youtube.com/iframe_api"></script>
<script>
    let players = [];

    function onYouTubeIframeAPIReady() {
        const iframes = document.querySelectorAll('iframe[id^="player-"]');
        iframes.forEach(iframe => {
            const player = new YT.Player(iframe.id, {
                events: {
                    'onStateChange': onPlayerStateChange
                }
            });
            players.push(player);
        });
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
    function mostrarRanking(id, boton) {
    document.querySelectorAll('.ranking-concurso').forEach(div => div.classList.remove('active'));
    const seleccionado = document.getElementById('ranking-' + id);
    if (seleccionado) seleccionado.classList.add('active');

    document.querySelectorAll('.concurso-btn').forEach(btn => btn.classList.remove('active'));
    if (boton) boton.classList.add('active');
    }

</script>
@endsection


@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-5" style="color: #1E484B;">🎶 Todos los Géneros Musicales</h2>

    @foreach($generoVideos as $bloque)
        <h3 class="text-secondary mt-5">{{ ucfirst($bloque['genero']) }}</h3>

        <div class="row">
            @foreach($bloque['videos'] as $video)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $video->titulo }}</h5>
                            <p class="card-text"><strong>Artista:</strong> {{ $video->usuario->nombre }}</p>

                            <div class="ratio ratio-16x9">
                                <iframe id="player-{{ $video->id }}"
                                        src="{{ $video->embed_url }}"
                                        frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mb-5">
            <a href="{{ route('comunidad.genero', ['genero' => $bloque['genero']]) }}" class="btn btn-outline-dark">
                Ver más de {{ ucfirst($bloque['genero']) }}
            </a>
        </div>
    @endforeach
</div>
@endsection

@section('scripts')
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
@endsection



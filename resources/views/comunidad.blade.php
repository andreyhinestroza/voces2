@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
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
            <a href="{{ route('auth.google') }}" class="btn btn-outline-primary w-100">Inicia sesión con Google</a>
          </li>
        @endauth
      </ul>
    </div>

    <!-- Contenido principal -->
    <div class="col-md-9">
      <div class="mb-4 text-center">
        <img src="{{ asset('img/propaganda.png') }}" alt="Publicidad Alcaldía"
             class="img-fluid w-100"
             style="box-shadow: 0 0 20px rgba(0,0,0,0.3); border-radius: 0;">
      </div>

      <h2 class="text-center mt-3" style="color: #1E484B;">🎤 Comunidad Activa</h2>
      <h2 class="mt-5 mb-4" style="color: #000000; font-weight: bold;">Concursos</h2>

      <div class="concursos-buttons d-flex flex-wrap mb-3">
        @foreach($concursos as $i => $concurso)
          @php $activo = $concurso->estado === 'activo' && $concurso->activo == 1; @endphp
          <button type="button"
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
                <div class="card h-100 shadow-sm">
                  <div class="card-body">
                    <h5 class="card-title">{{ $video->titulo }}</h5>
                    <p class="card-text"><strong>Género:</strong> {{ $video->genero }}</p>
                    <p class="card-text"><strong>Artista:</strong> {{ $video->usuario->nombre }}</p>
                    <div class="ratio ratio-16x9">
                      <iframe id="player-{{ $video->id }}" src="{{ $video->embed_url }}" frameborder="0" allowfullscreen></iframe>
                    </div>

                    
                    @php
                      $yaMeGusta = $video->favoritos->isNotEmpty();
                      $yaComento = $video->comentarios->isNotEmpty();
                    @endphp

                    <div class="acciones mt-3 d-flex justify-content-center gap-2">
                      <button class="btn btn-sm {{ $yaMeGusta ? 'btn-primary' : 'btn-outline-primary' }} js-btn-favorito"
                              data-video-id="{{ $video->id }}">
                        👍 Me gusta (<span id="fav-count-{{ $video->id }}">{{ $video->favoritos_count ?? 0 }}</span>)
                      </button>

                      <button class="btn btn-sm btn-outline-success js-btn-voto"
                              data-video-id="{{ $video->id }}"
                              data-concurso-id="{{ $video->id_concurso }}">
                        🗳️ Votar (<span id="vote-count-{{ $video->id }}">{{ $video->votos_count ?? 0 }}</span>)
                      </button>

                      <button class="btn btn-sm {{ $yaComento ? 'btn-secondary' : 'btn-outline-secondary' }}"
                              data-bs-toggle="modal"
                              data-bs-target="#modalComentario-{{ $video->id }}">
                        💬 Comentar (<span id="comment-count-{{ $video->id }}">{{ $video->comentarios_count ?? 0 }}</span>)
                      </button>
                    </div>



<!-- Comentarios debajo del video -->
<div class="mt-4 px-3">
  <h6 class="text-muted mb-2">Comentarios:</h6>
  <div style="max-height:250px; overflow-y:auto; border:1px solid #1E484B; border-radius:6px; background-color:#f9f9f9; padding:12px;">
    @forelse($video->comentarios as $comentario)
      <div style="margin-bottom:16px; padding-bottom:10px; border-bottom:1px solid #ccc;">
        <strong style="color:#00A06E; font-family:Montserrat, sans-serif;">{{ $comentario->usuario->name }}</strong>
        <p style="margin:4px 0; font-family:Montserrat, sans-serif;">{{ $comentario->comentario }}</p>
        <small class="text-muted">{{ $comentario->created_at->format('d/m/Y h:i A') }}</small>
      </div>
    @empty
      <p class="text-muted">Aún no hay comentarios.</p>
    @endforelse
  </div>
</div>






                  </div>
                </div>
              </div>






              <!-- Modal comentario por video -->
              <div class="modal fade" id="modalComentario-{{ $video->id }}" tabindex="-1">
                <div class="modal-dialog">
                  <form class="modal-content js-form-comentario" data-video-id="{{ $video->id }}">
                    <div class="modal-body">
                      <textarea class="form-control" name="comentario" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                  </form>
                </div>
              </div>
            @empty
              <div class="col-12">
                <div class="alert alert-info text-center">No hay videos disponibles en este momento.</div>
              </div>
            @endforelse
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>

<!-- Modal confirmación genérico -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="font-family: 'Montserrat', sans-serif;">
      <div class="modal-header" style="border-bottom: none;">
        <h5 class="modal-title" style="color:#1E484B;">Confirmar acción</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body" id="confirmMessage">¿Deseas continuar?</div>
      <div class="modal-footer" style="border-top: none;">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn" id="confirmOkBtn" style="background:#00A06E;color:#fff;">Aceptar</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="https://www.youtube.com/iframe_api"></script>
<script>
  // --- YouTube API: pausa otros videos cuando uno se reproduce ---
  let players = [];
  function onYouTubeIframeAPIReady() {
    const iframes = document.querySelectorAll('iframe[id^="player-"]');
    iframes.forEach(iframe => {
      const player = new YT.Player(iframe.id, { events: { 'onStateChange': onPlayerStateChange } });
      players.push(player);
    });
  }
  function onPlayerStateChange(event) {
    if (event.data === YT.PlayerState.PLAYING) {
      players.forEach(p => { if (p !== event.target) p.pauseVideo(); });
    }
  }

  // --- Mostrar ranking activo ---
  function mostrarRanking(id, boton) {
    document.querySelectorAll('.ranking-concurso').forEach(div => div.classList.remove('active'));
    const seleccionado = document.getElementById('ranking-' + id);
    if (seleccionado) seleccionado.classList.add('active');
    document.querySelectorAll('.concurso-btn').forEach(btn => btn.classList.remove('active'));
    if (boton) boton.classList.add('active');
  }

  // --- CSRF token ---
  const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  // --- Confirmación genérica ---
  function confirmarAccion(mensaje, onOk) {
    const msgEl = document.getElementById('confirmMessage');
    const okBtn = document.getElementById('confirmOkBtn');
    msgEl.textContent = mensaje;
    const modalEl = document.getElementById('confirmModal');
    const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
    modal.show();
    const handler = async () => {
      okBtn.removeEventListener('click', handler);
      modal.hide();
      await onOk();
    };
    okBtn.addEventListener('click', handler);
  }

  // --- Acción: Me gusta ---
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.js-btn-favorito');
    if (!btn) return;
    const videoId = btn.dataset.videoId;
    confirmarAccion('¿Quieres marcar este video como favorito?', async () => {
      const res = await fetch('{{ route('interacciones.favorito') }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
        body: JSON.stringify({ video_id: videoId })
      });
      const data = await res.json();
      console.log('Favorito:', data);
      if (data.ok) {
        document.getElementById(`fav-count-${videoId}`).textContent = data.total;
        btn.classList.toggle('btn-outline-primary');
        btn.classList.toggle('btn-primary');
      } else {
        alert(data.msg || 'No se pudo guardar el favorito.');
      }
    });
  });

  // --- Acción: Votar ---
  document.addEventListener('click', (e) => {
  const btn = e.target.closest('.js-btn-voto');
  if (!btn) return;

  const videoId = btn.dataset.videoId;
  const concursoId = btn.dataset.concursoId;

  console.log('Datos enviados:', { videoId, concursoId });

  confirmarAccion('¿Confirmas tu voto para este video?', async () => {
    const res = await fetch('/interacciones/voto', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify({ video_id: videoId, concurso_id: concursoId })
    });

    const data = await res.json();
    console.log('Respuesta voto:', data);

    if (data.ok) {
      document.getElementById(`vote-count-${videoId}`).textContent = data.total;
      btn.classList.toggle('btn-outline-success');
      btn.classList.toggle('btn-success');
    } else {
      alert(data.msg || 'No se pudo registrar el voto.');
    }
  });
});


  // --- Acción: Guardar comentario ---
  document.addEventListener('submit', async (e) => {
    const form = e.target.closest('.js-form-comentario');
    if (!form) return;
    e.preventDefault();
    const videoId = form.dataset.videoId;
    const comentario = form.querySelector('textarea[name="comentario"]').value.trim();
    if (!comentario) return;
    confirmarAccion('¿Deseas guardar este comentario?', async () => {
      const res = await fetch('{{ route('interacciones.comentario') }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
        body: JSON.stringify({ video_id: videoId, comentario })
      });
      const data = await res.json();
      console.log('Comentario:', data);
      if (data.ok) {
        document.getElementById(`comment-count-${videoId}`).textContent = data.total;
        const modalEl = document.getElementById(`modalComentario-${videoId}`);
        const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
        modal.hide();
      } else {
        alert(data.msg || 'No se pudo guardar el comentario.');
      }
    });
  });
</script>
@endsection










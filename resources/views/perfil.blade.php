@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Columna izquierda -->
            <div class="col-md-4">
                <div class="profile-card">
                    <img src="{{ $usuario->foto ?? asset('img/usuario.png') }}" alt="Foto de perfil">
                    <h5 class="mb-1">{{ $usuario->nombre ?? 'Usuario' }}</h5>
                    <p class="text-muted">Miembro desde {{ $usuario->fecha_registro->format('Y') ?? '2025' }}</p>
                    <hr />
                    <p><strong>Correo:</strong> {{ $usuario->correo ?? 'correo@ejemplo.com' }}</p>
                    <p><strong>Tipo de usuario:</strong> {{ ucfirst($usuario->rol) ?? 'Espectador' }}</p>

                    @if($usuario->rol === 'participante')
                        @php
                            $votosRecibidos = $misVideos->sum('votos_count');
                            $concursosInscritos = $concursos->count();
                        @endphp
                        <p><strong>Votos recibidos:</strong> {{ $votosRecibidos }}</p>
                        <p><strong>Concursos inscritos:</strong> {{ $concursosInscritos }}</p>
                    @endif

                    @if($usuario->rol === 'espectador')
                        <p><strong>Votos emitidos:</strong> {{ $usuario->votosEmitidos->count() ?? 0 }}</p>
                    @endif
                </div>

                <div class="notification-box mt-4">
                    <h6><i class="fas fa-bell me-2"></i> Notificaciones</h6>
                    <ul class="mt-2">
                        <li>Tu video ha sido aprobado para el concurso del Valentón</li>
                        <li>Has recibido 10 nuevos votos</li>
                        <li>Nuevo mensaje en el video "Mi Tierra Linda"</li>
                    </ul>
                </div>



            </div>

            <!-- Columna derecha -->
            <div class="col-md-8">
                @if($usuario->rol === 'participante')
                    <!-- Tabs para participante -->
                    <ul class="nav nav-tabs mb-3" id="perfilTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="concursos-tab" data-bs-toggle="tab" data-bs-target="#concursos"
                                type="button" role="tab">Mis Concursos</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="videos-tab" data-bs-toggle="tab" data-bs-target="#videos" type="button"
                                role="tab">Mis Videos</button>
                        </li>
                    </ul>

                    <!-- Contenido de pestañas -->
                    <div class="tab-content" id="perfilTabsContent">
                        <!-- Tab: Mis Concursos -->
                        <div class="tab-pane fade show active" id="concursos" role="tabpanel">
                            @forelse($concursos as $concurso)
                                @php
                                    $videosConcurso = $misVideos->where('id_concurso', $concurso->id);
                                @endphp

                                <div class="concurso-box mb-4">
                                    <h5 class="concurso-title">{{ $concurso->nombre }}</h5>
                                    <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($concurso->fecha_inicio)->format('d/m/Y') }}
                                    </p>
                                    <p><strong>Videos inscritos:</strong> {{ $videosConcurso->count() }}</p>
                                    <p><strong>Votos recibidos:</strong> {{ $videosConcurso->sum('votos_count') }}</p>
                                </div>



                                <div class="row">
                                    @forelse($videosConcurso as $video)
                                        <div class="col-md-4 mb-4">
                                            <div class="card h-100 border-primary shadow-sm">
                                                <div class="card-body">
                                                    <h6 class="card-title">{{ $video->titulo }}</h6>
                                                    <p><strong>Género:</strong> {{ ucfirst($video->genero) }}</p>
                                                    <p><strong>Concurso:</strong> {{ $concurso->nombre }}</p>
                                                    <p><strong>Votos:</strong> {{ $video->votos_count }}</p>
                                                    <div class="ratio ratio-16x9">
                                                        <iframe src="{{ $video->embed_url }}?enablejsapi=1" frameborder="0"
                                                            allowfullscreen></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <div class="alert alert-info text-center">
                                                No tienes videos inscritos en este concurso.
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            @empty
                                <div class="alert alert-warning text-center">
                                    Aún no estás inscrito en ningún concurso.
                                </div>
                            @endforelse
                        </div>

                        <!-- Tab: Mis Videos -->
                        <div class="tab-pane fade" id="videos" role="tabpanel">
                            @forelse($misVideos as $video)
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-body">
                                        <div style="display:flex; justify-content:space-between; align-items:center;">
                                            <div>
                                                <h6 class="card-title" style="margin:0;">{{ $video->titulo }}</h6>
                                                <p style="margin:0;"><strong>Género:</strong> {{ ucfirst($video->genero) }}</p>
                                            </div>
                                            <button onclick="abrirSelectorConcurso({{ $video->id }})" style="
                                                                                  background-color:#FAC00B;
                                                                                  color:#1E484B;
                                                                                  font-weight:bold;
                                                                                  font-family:Montserrat, sans-serif;
                                                                                  border:none;
                                                                                  border-radius:6px;
                                                                                  padding:6px 12px;
                                                                                  transition:background-color 0.3s ease, box-shadow 0.3s ease;
                                                                                "
                                                onmouseover="this.style.backgroundColor='#1E484B'; this.style.color='#ffffff'; this.style.boxShadow='0 6px 20px rgba(0,0,0,0.6)';"
                                                onmouseout="this.style.backgroundColor='#FAC00B'; this.style.color='#1E484B'; this.style.boxShadow='none';">
                                                📋 Participar en concurso
                                            </button>
                                        </div>

                                        <p><strong>Concurso:</strong> {{ $video->concurso->nombre ?? 'Sin concurso' }}</p>
                                        <p><strong>Votos recibidos:</strong> {{ $video->votos_count }}</p>

                                        <div class="ratio ratio-16x9">
                                            <iframe src="{{ $video->embed_url }}?enablejsapi=1" frameborder="0"
                                                allowfullscreen></iframe>
                                        </div>


                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-info text-center">
                                    Aún no has subido ningún video.
                                </div>
                            @endforelse
                        </div>
                    </div>
                @elseif($usuario->rol === 'administrador')
                    <!-- Tabs para administrador -->
                    <ul class="nav nav-tabs mb-3" id="perfilTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="gestionar-tab" data-bs-toggle="tab" data-bs-target="#gestionar"
                                type="button" role="tab">Gestión de Concursos</button>
                        </li>
                    </ul>
                @elseif($usuario->rol === 'espectador')
                    <!-- Vista especial para espectador -->
                    <div class="alert alert-info text-center mb-4">
                        <i class="fas fa-eye me-2"></i> Como espectador puedes visualizar videos, votar y guardar tus favoritos.
                    </div>

                    <!-- Sección: Videos que me gustan -->
                    <!-- Sección: Videos votados por mí -->
                    <h5 class="text-secondary mt-5 mb-3"><i class="fas fa-vote-yea me-2"></i> Videos votados por mí</h5>
                    <div class="row">
                        @forelse($votados as $video)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 border-success shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $video->titulo }}</h6>
                                        <p class="card-text"><strong>Artista:</strong> {{ $video->usuario->nombre }}</p>
                                        <p class="card-text"><strong>Género:</strong> {{ ucfirst($video->genero) }}</p>
                                        <div class="ratio ratio-16x9">
                                            <iframe src="{{ $video->embed_url }}?enablejsapi=1" frameborder="0"
                                                allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info text-center">
                                    Aún no has votado por ningún video.
                                </div>
                            </div>
                        @endforelse
                    </div>
                @endif
            </div> <!-- cierre col-md-8 -->
        </div> <!-- cierre row -->
    </div> <!-- cierre container -->
    
    <!-- Modal: Selector de concursos -->
    <div class="modal fade" id="modalSelectorConcurso" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" style="font-family: Montserrat;">
                <div class="modal-header">
                    <h5 class="modal-title">Selecciona un concurso activo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="listaConcursos"></div>
            </div>
        </div>
    </div>

    <!-- Modal: Confirmar inscripción -->
    <div class="modal fade" id="modalConfirmarConcurso" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" style="font-family: Montserrat;">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar participación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="detalleConcurso"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btnConfirmarInscripcion">Confirmar</button>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('scripts')
    <script>
        // 👉 Capturamos el token CSRF desde el <head>
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let videoIdSeleccionado = null;
        let concursoSeleccionado = null;



        function abrirSelectorConcurso(videoId) {
            videoIdSeleccionado = videoId;
            fetch('/api/concursos-activos')
                .then(res => res.json())
                .then(data => {
                    let lista = '';
                    data.forEach(concurso => {
                        lista += `
                      <button class="btn btn-outline-dark w-100 mb-2"
                        onclick="verificarParticipacion(${videoId}, ${concurso.id}, '${concurso.nombre}', '${concurso.descripcion}', '${concurso.fecha_inicio}', '${concurso.fecha_fin}')">
                        ${concurso.nombre}
                      </button>
                    `;
                    });
                    document.getElementById('listaConcursos').innerHTML = lista;
                    new bootstrap.Modal(document.getElementById('modalSelectorConcurso')).show();
                });
        }

        function verificarParticipacion(videoId, concursoId, nombre, descripcion, fechaInicio, fechaFin) {
            fetch(`/api/verificar-concurso?video_id=${videoId}&concurso_id=${concursoId}`)
                .then(res => res.json())
                .then(data => {
                    if (data.yaParticipa) {
                        alert(`Este video ya participa en el concurso "${nombre}".`);
                    } else {
                        mostrarConfirmacion(videoId, concursoId, nombre, descripcion, fechaInicio, fechaFin);
                    }
                });
        }

        function mostrarConfirmacion(videoId, concursoId, nombre, descripcion, fechaInicio, fechaFin) {
            const detalle = document.getElementById('detalleConcurso');
            detalle.innerHTML = `
                <p><strong>Concurso:</strong> ${nombre}</p>
                <p><strong>Descripción:</strong> ${descripcion}</p>
                <p><strong>Fechas:</strong> ${fechaInicio} al ${fechaFin}</p>
              `;
            videoIdSeleccionado = videoId;
            concursoSeleccionado = concursoId;
            new bootstrap.Modal(document.getElementById('modalConfirmarConcurso')).show();
        }

        document.getElementById('btnConfirmarInscripcion').addEventListener('click', () => {
            fetch('/api/inscribir-video', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
                body: JSON.stringify({ video_id: videoIdSeleccionado, concurso_id: concursoSeleccionado })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.ok) {
                        alert('¡Video inscrito exitosamente!');
                        location.reload();
                    } else {
                        alert(data.msg || 'No se pudo inscribir el video.');
                    }
                });
        });
    </script>
@endsection
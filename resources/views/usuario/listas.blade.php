@extends('layouts.app')



@section('content')
<style>
  .fixed-sidebar {
    position: fixed;
    top: 70px;
    left: 0;
    width: 320px;
    bottom: 0;
    overflow-y: auto;
    background-color: #1E484B;
    z-index: 10;
    padding: 20px;
    font-family: Montserrat;
  }

  .main-content {
    margin-left: 320px;
    padding: 20px;
    min-height: calc(100vh - 70px);
    max-width: calc(100% - 320px); /* evita desbordamiento */
    overflow-x: hidden;
  }

  footer {
    position: relative;
    z-index: 20;
    background-color: #1E484B;
    color: white;
    font-family: Montserrat;
    padding: 40px 20px;
  }

  @media (max-width: 768px) {
    .fixed-sidebar {
      position: static;
      width: 100%;
      height: auto;
    }

    .main-content {
      margin-left: 0;
      max-width: 100%;
    }
  }

  .card-body, .card-header, .lista-item {
    word-wrap: break-word;
    word-break: break-word;
    max-width: 100%;
  }

  .card-header h6, .card-title, .card-text, .card-body p {
    overflow-wrap: break-word;
    white-space: normal;
  }
</style>
     <!-- Panel izquierdo institucional -->
        <!-- Panel izquierdo fijo -->
<div class="fixed-sidebar">
  @include('partials.sidebar')
</div>


    <!-- Contenido principal -->
    <div class="main-content">
      <div class="p-3 mb-4 rounded d-flex justify-content-between align-items-center flex-wrap" style="background-color:#00A06E; color:white; font-family:Montserrat;">
        <h4 class="m-0">🎵 Mis listas de reproducción</h4>
        <button class="btn btn-light fw-bold mt-2 mt-md-0" onclick="mostrarFormularioCrear()">➕ Crear nueva lista</button>
      </div>



      <!-- Filtro de listas -->
      <div class="mb-3">
        <input type="text" class="form-control" placeholder="🔍 Filtrar listas por nombre..." onkeyup="filtrarListas(this.value)">
      </div>

      <!-- Formulario para crear/editar lista -->
      <div id="formularioLista" class="mb-4 p-3 rounded" style="background-color:#f0fdf4; border:1px solid #00A06E; display:none;">
        <h5 style="color:#00A06E;">✏️ Crear / Editar lista</h5>
            <form id="formLista" method="POST" action="{{ route('listas.guardar') }}">
                @csrf
                <input type="hidden" name="id" id="lista_id">
                <input type="text" name="nombre" id="nombre" class="form-control mb-2" placeholder="Nombre de la lista" required>
                <textarea name="descripcion" id="descripcion" class="form-control mb-2" placeholder="Descripción (opcional)"></textarea>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-outline-secondary" onclick="ocultarFormulario()">Cancelar</button>
            </form>


      </div>

      <!-- Listas existentes -->
      @forelse($listas as $lista)
        <div class="card mb-4 shadow-sm lista-item" data-nombre="{{ strtolower($lista->nombre) }}">
          <div class="card-header d-flex justify-content-between align-items-center" style="background-color:#1E484B; color:white;">
            <strong>{{ $lista->nombre }}</strong>
            <div>
                <button class="btn btn-sm btn-warning me-1" onclick="editarLista('{{ $lista->id }}', '{{ $lista->nombre }}', '{{ $lista->descripcion }}')">✏️ Editar Titulos</button>
                <button class="btn btn-sm btn-info me-1" onclick="mostrarEditarVideos('{{ $lista->id }}')">🎬 Editar videos</button>
                <button class="btn btn-sm btn-danger" onclick="confirmarEliminacion('{{ $lista->id }}', '{{ $lista->nombre }}')">🗑️ Eliminar</button>
            </div>
        </div>

          <div class="card-body">
            <p>{{ $lista->descripcion }}</p>
            <div class="row">
              @forelse($lista->videos as $video)
                <div class="col-md-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6>{{ $video->titulo }}</h6>
                      <p><strong>Artista:</strong> {{ $video->usuario->nombre }}</p>
                      <p><strong>Género:</strong> {{ $video->genero }}</p>
                      <div class="ratio ratio-16x9">
                        @if($video->embed_url)
                            <iframe src="{{ $video->embed_url }}" frameborder="0" allowfullscreen></iframe>
                        @else
                            <p class="text-danger">⚠️ Video no disponible</p>
                        @endif
                        </div>

                      <button class="btn btn-sm btn-outline-danger mt-2" onclick="quitarVideo('{{ $lista->id }}', '{{ $video->id }}')">❌ Quitar de la lista</button>

                    </div>
                  </div>
                </div>
              @empty
                <p class="text-muted">Esta lista no tiene videos aún.</p>
              @endforelse
            </div>
          </div>
        </div>
      @empty
        <p class="text-muted">No has creado ninguna lista de reproducción.</p>
      @endforelse
    </div>
  </div>
</div>

<!-- Formulario invisible para eliminar lista -->
<form id="formEliminarLista" method="POST" style="display:none;">
  @csrf
  @method('DELETE')
</form>

<!-- Modal institucional para editar videos -->
<div class="modal fade" id="modalEditarVideos" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content" style="border:2px solid #1E484B;">
      <div class="modal-header" style="background-color:#1E484B; color:white; font-family:Montserrat;">
        <h5 class="modal-title">🎬 Editar videos de la lista</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body" style="background-color:#f9f9f9;">
        <div id="videosDisponibles" class="row">
          <!-- Aquí se cargarán dinámicamente los videos -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" onclick="guardarVideosLista()">💾 Guardar cambios</button>
      </div>
    </div>
  </div>
</div>


<!-- Scripts interactivos -->
<script>
    // variable global para rastrear videos ya agregados
    let videosAgregados = new Set();

  // Quitar video de la lista
  function quitarVideo(listaId, videoId) {
  const mensaje = `⚠️ Estás a punto de quitar este video de la lista.\n\nEsta acción no elimina el video, solo lo desvincula de esta lista.\n\n¿Deseas continuar?`;

  if (confirm(mensaje)) {
    fetch(`/listas-reproduccion/${listaId}/videos/${videoId}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert('✅ Video eliminado de la lista');
        location.reload();
      } else {
        alert('❌ No se pudo eliminar el video');
      }
    });
  }
}


  function confirmarEliminacion(id, nombre) {
    const mensaje = `⚠️ Estás a punto de eliminar la lista "${nombre}".\n\nEsta acción es permanente y no habrá forma de recuperarla.\n\n¿Deseas continuar?`;
    
    if (confirm(mensaje)) {
        const form = document.getElementById('formEliminarLista');
        form.action = '/listas-reproduccion/' + id;
        form.submit();
    }
    }

  

  function editarLista(id, nombre, descripcion) {
  document.getElementById('formularioLista').style.display = 'block';
  document.getElementById('lista_id').value = id;
  document.getElementById('nombre').value = nombre;
  document.getElementById('descripcion').value = descripcion;
  document.getElementById('formLista').action = '/listas-reproduccion/' + id + '/editar';
  }


  function mostrarFormularioCrear() {
    document.getElementById('formularioLista').style.display = 'block';
  }

  function ocultarFormulario() {
    event.preventDefault();
    document.getElementById('formularioLista').style.display = 'none';
  }

  function filtrarListas(valor) {
    valor = valor.toLowerCase();
    document.querySelectorAll('.lista-item').forEach(function(lista) {
      lista.style.display = lista.dataset.nombre.includes(valor) ? 'block' : 'none';
    });
  }

    function mostrarEditarVideos(listaId) {
    // Abrir modal
    const modal = new bootstrap.Modal(document.getElementById('modalEditarVideos'));
    modal.show();

    // Cargar videos desde backend vía AJAX
    fetch('/videos-disponibles')
        .then(response => response.json())
        .then(videos => {
        const contenedor = document.getElementById('videosDisponibles');
        contenedor.innerHTML = '';

        videos.forEach(video => {
            contenedor.innerHTML += `
            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h6 style="color:#1E484B; font-family:Montserrat;">${video.titulo}</h6>
                    <p><strong>Género:</strong> ${video.genero}</p>
                    <div class="ratio ratio-16x9 mb-2">
                    <iframe src="${video.embed_url}" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <button id="btn-agregar-${video.id}" class="btn btn-sm btn-outline-success" onclick="agregarVideo(${listaId}, ${video.id})">➕ Agregar</button>

                </div>
                </div>
            </div>
            `;
        });
        });
    }

    function agregarVideo(listaId, videoId) {
    fetch(`/listas-reproduccion/${listaId}/videos`, {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ video_id: videoId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
        videosAgregados.add(videoId); // ✅ guardar el ID
        const boton = document.getElementById(`btn-agregar-${videoId}`);
        if (boton) {
            boton.classList.remove('btn-outline-success');
            boton.classList.add('btn-dark');
            boton.innerText = '✅ Agregado';
            boton.disabled = true;
        }
        } else {
        alert('❌ No se pudo agregar el video');
        }
    });
    }


    function guardarVideosLista() {
    alert('💾 Cambios guardados correctamente');
    location.reload();
    }


</script>
@endsection

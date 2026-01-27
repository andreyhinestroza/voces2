@extends('layouts.app')

@section('content')
<style>
  .fixed-sidebar {
    position: fixed;
    top: 70px; /* espacio para navbar */
    left: 0;
    width: 320px;
    bottom: 0; /* asegura que no se extienda debajo del viewport */
    overflow-y: auto;
    background-color: #1E484B;
    z-index: 10;
    padding: 20px;
    font-family: Montserrat;
  }

  .main-content {
    margin-left: 320px;
    padding: 20px;
    min-height: calc(100vh - 70px); /* asegura que el contenido empuje el footer */
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
    }
  }
</style>

<!-- Panel izquierdo fijo -->
<div class="fixed-sidebar">
  @include('partials.sidebar')
</div>

<!-- Contenido principal desplazable -->
<div class="main-content">
  <div class="p-3 mb-4 rounded" style="background-color:#00A06E; color:white; font-family:Montserrat;">
    <h4 class="m-0">🗳️ Videos que he votado</h4>
  </div>

  <div class="row">
    @forelse($videos as $video)
      <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title" style="color:#1E484B; font-family:Montserrat;">{{ $video->titulo }}</h5>
            <p class="card-text"><strong>Artista:</strong> {{ $video->usuario->nombre }}</p>
            <p class="card-text"><strong>Género:</strong> {{ $video->genero }}</p>
            <div class="ratio ratio-16x9">
              <iframe src="{{ $video->embed_url }}" frameborder="0" allowfullscreen></iframe>
            </div>
          </div>
        </div>
      </div>
    @empty
      <p class="text-muted">Aún no has votado por ningún video.</p>
    @endforelse
  </div>
</div>
@endsection

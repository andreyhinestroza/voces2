@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
          <!-- Panel izquierdo institucional -->
        <div class="col-md-3 bg-light border-end" style="height: 100vh; overflow-y: auto;">
            @include('partials.sidebar')
        </div>

    <!-- Contenido principal -->
    <div class="col-md-9">
      <h4 class="mt-3 mb-4" style="color:#1E484B; font-family:Montserrat;">👍 Videos que me gustan</h4>
      <div class="row">
        @forelse($videos as $video)
          <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <h5 class="card-title">{{ $video->titulo }}</h5>
                <p class="card-text"><strong>Artista:</strong> {{ $video->usuario->nombre }}</p>
                <p class="card-text"><strong>Género:</strong> {{ $video->genero }}</p>
                <div class="ratio ratio-16x9">
                  <iframe src="{{ $video->embed_url }}" frameborder="0" allowfullscreen></iframe>
                </div>
              </div>
            </div>
          </div>
        @empty
          <p class="text-muted">Aún no has marcado videos con 👍 Me gusta.</p>
        @endforelse
      </div>
    </div>
  </div>
</div>
@endsection

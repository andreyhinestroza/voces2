@extends('layouts.app')

@section('content')
<div class="container">
  <h4 style="color:#1E484B; font-family:Montserrat;">🕓 Últimos movimientos</h4>

  <h5 style="color:#00A06E;">🗳️ Votos recientes</h5>
  <ul>
    @foreach($ultimosVotos as $voto)
      <li>{{ $voto->video->titulo }}</li>
    @endforeach
  </ul>

  <h5 style="color:#00A06E;">💬 Comentarios recientes</h5>
  <ul>
    @foreach($ultimosComentarios as $comentario)
      <li>{{ $comentario->video->titulo }} — "{{ $comentario->comentario }}"</li>
    @endforeach
  </ul>

  <h5 style="color:#00A06E;">👍 Favoritos recientes</h5>
  <ul>
    @foreach($ultimosFavoritos as $favorito)
      <li>{{ $favorito->video->titulo }}</li>
    @endforeach
  </ul>
</div>
@endsection

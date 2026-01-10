@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-success">Sube tu Video</h2>

    <!-- Mensajes de éxito o error -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('video.store') }}" method="POST">
        @csrf

        <!-- Título -->
        <div class="mb-3">
            <label for="titulo" class="form-label">Título del Video</label>
            <input type="text" name="titulo" id="titulo" class="form-control" required>
        </div>

        <!-- URL de YouTube -->
        <div class="mb-3">
            <label for="url_video" class="form-label">Enlace de YouTube</label>
            <input type="url" name="url_video" id="url_video" class="form-control" 
                   placeholder="https://www.youtube.com/watch?v=..." required>
        </div>

        <!-- Género musical -->
        <div class="mb-3">
            <label for="genero" class="form-label">Género Musical</label>
            <select name="genero" id="genero" class="form-select" required>
                <option value="">Selecciona un género</option>
                <option value="salsa">Salsa</option>
                <option value="pop">Pop</option>
                <option value="folclor">Folclor</option>
                <option value="vallenato">Vallenato</option>
                <option value="ranchera">Ranchera</option>
                <option value="bolero">Bolero</option>
                <option value="otro">Otro</option>
            </select>
        </div>

        <!-- Concurso -->
        <div class="mb-3">
            <label for="id_concurso" class="form-label">Concurso</label>
            <select name="id_concurso" id="id_concurso" class="form-select" required>
                @foreach($concursos as $concurso)
                    <option value="{{ $concurso->id }}">{{ $concurso->nombre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Botón -->
        <button type="submit" class="btn btn-success">Publicar Video</button>
    </form>
</div>
@endsection

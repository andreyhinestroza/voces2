@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-warning">Convertirse en Participante</h2>
    <p>Para subir videos debes ser participante. ¿Quieres cambiar tu rol?</p>

    <form action="{{ route('convertirse.participante.store') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-warning">Sí, convertirme en participante</button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Top 5 Ranking - Las voces de mi pueblo')

@section('content')
    <style>
        .animated-bg {
            background: linear-gradient(270deg, #E0F7FA, #FFFDE7, #F1F8E9);
            background-size: 400% 400%;
            animation: moveBg 90s linear infinite;
        }

        @keyframes moveBg {
            0% {
                background-position: 0% 50%;
            }

            100% {
                background-position: 100% 50%;
            }
        }

        .ranking-card {
            width: 280px;
            /* 👈 ancho fijo */
            min-height: 420px;
            margin: 10px;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            text-align: center;
            flex-shrink: 0;
            /* 👈 evita que se reduzca */
        }

        .ranking-card:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.25);
        }

        .ranking-number {
            position: absolute;
            bottom: 5px;
            /* 👈 más pegado al borde inferior */
            left: 50%;
            /* 👈 centrado horizontal */
            transform: translateX(-50%);
            width: 160px;
            /* 👈 círculo grande para acomodar font-size 120 */
            height: 160px;
            border-radius: 50%;
            /* 👈 círculo perfecto */
            background-color: rgba(64, 119, 122, 0.18);
            /* 👈 más transparente */
            color: #fff;
            /* 👈 número en blanco */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 120px;
            /* 👈 número grande */
            font-weight: bold;
            z-index: 2;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.25);
        }





        .ranking-content {
            position: relative;
            z-index: 1;
            padding-bottom: 16px;
        }

        .medal {
            font-size: 28px;
            margin-bottom: 8px;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 50;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border-radius: 12px;
            width: 80%;
            max-width: 800px;
            position: relative;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 28px;
            font-weight: bold;
            color: #333;
            cursor: pointer;
        }



        /* Tarjeta de título institucional */
        .section-title-card {
            width: 75%;
            margin: 1rem auto;
            /* 👈 menos espacio arriba y abajo */
            background: linear-gradient(90deg, #004d3f, #00A06E, #004d3f);
            border-radius: 20px;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.35);
            padding: 30px 24px;
            /* 👈 menos espacio interno arriba/abajo */
            text-align: center;
            font-family: 'Montserrat', sans-serif;
            color: #ffffff;
        }

        .section-title-icon {
            width: 100px;
            /* más grande */
            height: 100px;
            border-radius: 50%;
            background: #FAC00B;
            /* dorado institucional */
            color: #000000;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 56px;
            /* icono grande */
            font-weight: 700;
            margin: 0 auto 20px auto;
            box-shadow: 0 6px 18px rgba(250, 192, 11, 0.45);
            /* brillo dorado */
        }

        .section-title-text {
            font-size: 2.8rem;
            /* equivalente a text-5xl */
            font-weight: 700;
            margin-bottom: 12px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.25);
            /* sombra en letras */
        }

        .section-title-sub {
            font-size: 1.3rem;
            font-weight: 500;
            opacity: 0.95;
        }

        .section-title-text {
            color: #ffffffff;
            font-size: 2.5rem;
            /* equivalente a text-4xl */
            font-weight: 700;
            text-shadow: 1px 1px 2px rgba(243, 241, 241, 1);
            margin-bottom: 8px;
        }

        .section-title-sub {
            color: #ffffff;
            /* letras blancas */
            font-size: 1.1rem;
            /* tamaño */
            font-weight: 700;
            /* 👈 ahora en negrilla */
            opacity: 0.85;
            /* ligera transparencia */
        }

        /* Botones de concursos */
        .concursos-buttons {
            max-width: 960px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
        }

        .concurso-btn {
            font-family: 'Montserrat', sans-serif;
            padding: 10px 18px;
            border-radius: 999px;
            border: 2px solid #1E484B;
            background-color: #ffffff;
            color: #1E484B;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
        }

        .concurso-btn:hover {
            background-color: #00A06E;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 160, 110, 0.30);
        }

        .concurso-btn.active {
            background-color: #1E484B;
            color: #ffffff;
            box-shadow: 0 8px 20px rgba(30, 72, 75, 0.35);
            border-color: #1E484B;
        }


        /* Encapsular estilos para no afectar otras partes */
        .ranking-concursos-section {
            font-family: 'Montserrat', sans-serif;
            margin-top: 2rem;
        }

        /* Tarjeta de título */
        .ranking-concursos-card {
            max-width: 960px;
            margin: 1rem auto;
            /* menos espacio arriba y abajo */
            background: linear-gradient(90deg, #004d3f, #00A06E, #004d3f);
            /* degradado institucional */
            border-radius: 16px;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.35);
            /* sombra más fuerte */
            border: none;
            /* quitamos borde sólido para que luzca el degradado */
            padding: 40px 24px;
            /* 👈 conservamos tu tamaño */
            text-align: center;
            font-family: 'Montserrat', sans-serif;
            color: #ffffff;
            /* letras blancas */
        }

        .ranking-concursos-icon {
            width: 64px;
            /* 👈 conservamos tamaño */
            height: 64px;
            border-radius: 50%;
            background: #FAC00B;
            /* dorado institucional */
            color: #000000;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            /* 👈 conservamos tamaño */
            font-weight: 700;
            margin: 0 auto 16px auto;
            box-shadow: 0 4px 12px rgba(250, 192, 11, 0.45);
            /* brillo dorado */
        }

        .ranking-concursos-title {
            color: #ffffff;
            /* ahora blanco sobre fondo verde */
            font-size: 32px;
            /* 👈 conservamos tamaño */
            font-weight: 700;
            margin-bottom: 8px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.25);
            /* sombra para destacar */
        }

        .ranking-concursos-subtitle {
            color: #ffffff;
            /* blanco */
            font-size: 18px;
            /* 👈 conservamos tamaño */
            font-weight: 700;
            /* negrilla */
            opacity: 0.95;
            /* un poco más visible */
        }



        /* Contenedor de botones */
        .concursos-buttons {
            max-width: 960px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
        }

        /* Botón institucional */
        .concurso-btn {
            padding: 10px 18px;
            border-radius: 999px;
            border: 2px solid #1E484B;
            background-color: #ffffff;
            color: #1E484B;
            font-weight: 600;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease, color 0.2s ease;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
        }

        .concurso-btn:hover {
            background-color: #00A06E;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 160, 110, 0.30);
        }

        /* Estado activo (cuando se seleccione más adelante) */
        .concurso-btn.active {
            background-color: #1E484B;
            color: #ffffff;
            box-shadow: 0 8px 20px rgba(30, 72, 75, 0.35);
            border-color: #1E484B;
        }

        /* Ranking por concurso*/
        .ranking-concurso {
            display: none;
            /* oculto por defecto */
        }

        /* Contenedor del ranking activo (una columna centrada y ancha) */
        .ranking-concurso.active {
            display: flex;
            flex-direction: column;
            /* 👈 apiladas verticalmente */
            align-items: center;
            /* centradas */
            gap: 16px;
            margin-top: 2rem;
        }

        /* Tarjeta de ranking apilada (ancho equivalente a dos tarjetas) */
        .ranking-row {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: min(920px, 95%);
            /* ~2 tarjetas de 280px + gaps, responsivo */
            background: #ffffff;
            border: 2px solid #1E484B;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            display: grid;
            grid-template-columns: 96px 1fr 160px;
            /* medalla/posición | info | votos/acciones */
            align-items: center;
            gap: 16px;
            padding: 16px 20px;
            cursor: pointer;
        }

        /* Efecto hover */
        .ranking-row:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.25);
        }

        /* Columna izquierda: posición/medalla */
        .ranking-pos {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
        }

        .ranking-pos .medal {
            font-size: 28px;
        }

        .ranking-pos .number {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: #00A06E;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 20px;
            box-shadow: 0 4px 12px rgba(0, 160, 110, 0.35);
        }

        /* Columna central: información del video */
        .ranking-info h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 20px;
            font-weight: 700;
            color: #1E484B;
            margin: 0 0 4px 0;
        }

        .ranking-info p {
            font-size: 14px;
            color: #000000;
            margin: 2px 0;
        }

        /* Columna derecha: votos y acciones */
        .ranking-meta {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 8px;
        }

        .ranking-votes {
            background: #FAC00B;
            color: #000000;
            padding: 6px 12px;
            border-radius: 999px;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(250, 192, 11, 0.35);
        }

        .ranking-actions {
            display: flex;
            gap: 8px;
        }

        .ranking-actions .btn {
            padding: 6px 10px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            border: 2px solid #1E484B;
            background: #ffffff;
            color: #1E484B;
            transition: all 0.2s ease;
        }

        .ranking-actions .btn:hover {
            background: #00A06E;
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(0, 160, 110, 0.30);
        }

        /* Tarjeta de video en ranking */
        .ranking-card {
            width: 280px;
            margin: 10px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 16px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
            text-align: center;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding-bottom: 20px;
            /* espacio para botones */
            cursor: pointer;
            /* convierte el cursor en manito */
        }

        .ranking-fondo {
            position: relative;
            background-image: url('{{ asset('img/fondo-ranking.png') }}');
            background-repeat: no-repeat;
            background-size: cover;
            /* expande la imagen completa */
            background-position: center;
            background-attachment: fixed;
        }
    </style>

    <!-- Fondo de Ranking -->

    <div class="animated-bg min-h-screen py-12 mt-24">
        <!-- Tarjeta de título para Top 5 Ranking -->
        <div class="section-title-card">
            <div class="section-title-icon">🏆</div>
            <h1 class="section-title-text">Top 5 Ranking</h1>
            <p class="section-title-sub">Los 5 videos más votados de la plataforma</p>
        </div>

        <!-- Top 5 -->
        <div style="display:flex; justify-content:center; gap:2rem; flex-wrap:wrap;">
            @foreach($ranking->take(5) as $index => $item)
                <div class="ranking-card {{ $index < 3 ? 'scale-110' : '' }}" @if(!empty($item->embed_url))
                    onclick="openModal('{{ $item->embed_url }}', '{{ $item->titulo }}', '{{ ucwords($item->participante) }}')"
                @endif>
                    <div class="ranking-number">{{ $index + 1 }}</div>
                    <div class="ranking-content p-6">
                        @if($index == 0)
                            <div class="medal">🥇</div>
                        @elseif($index == 1)
                            <div class="medal">🥈</div>
                        @elseif($index == 2)
                            <div class="medal">🥉</div>
                        @else
                            <div class="medal">🏅</div>
                        @endif

                        <h2 class="text-lg font-bold mb-2 text-gray-800">{{ $item->titulo }}</h2>
                        <p class="text-sm text-gray-700 mb-1"><strong>Concurso:</strong> {{ $item->concurso }}</p>
                        <p class="text-sm text-gray-700 mb-1"><strong>Género:</strong> {{ ucfirst($item->genero) }}</p>
                        <p class="text-sm text-gray-700 mb-2"><strong>Participante:</strong> {{ ucwords($item->participante) }}
                        </p>
                        <span class="inline-block bg-[#FAC00B] text-black px-3 py-1 rounded-full font-bold">
                            {{ $item->votos }} votos
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="ranking-fondo"> <!-- Fondo de ranking por concursos -->
            <!-- Ranking por concursos -->
            <div class="ranking-concursos-section">
                <div class="ranking-concursos-card">
                    <div class="ranking-concursos-icon">🏆</div>
                    <div>
                        <div class="ranking-concursos-title">Ranking por concursos</div>
                        <div class="ranking-concursos-subtitle">Explora los concursos activos y sus participantes</div>
                    </div>
                    <div class="concursos-buttons">
                        @foreach($concursos as $i => $concurso)
                            <button type="button" class="concurso-btn {{ $i === 0 ? 'active' : '' }}"
                                onclick="mostrarRanking('{{ $concurso->id }}', this)">
                                {{ $concurso->nombre }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            @foreach($videosPorConcurso as $id => $videos)
                <div class="ranking-concurso {{ $loop->first ? 'active' : '' }}" id="ranking-{{ $id }}">
                    @foreach($videos as $index => $video)
                        @php
                            $pos = $index + 1;
                            $medal = $pos === 1 ? '🥇' : ($pos === 2 ? '🥈' : ($pos === 3 ? '🥉' : '🏅'));
                        @endphp

                        <div class="ranking-row" @if(!empty($video->embed_url))
                            onclick="openModal('{{ $video->embed_url }}', '{{ $video->titulo }}', '{{ $video->usuario->nombre }}')"
                        @endif>
                            <div class="ranking-pos">
                                <div class="number">{{ $pos }}</div>
                            </div>
                            <div class="ranking-info">
                                <h3>{{ $video->titulo }}</h3>
                                <p><strong>Participante:</strong> {{ $video->usuario->nombre }}</p>
                                <p><strong>Género:</strong> {{ ucfirst($video->genero) }}</p>
                            </div>
                            <div class="ranking-meta">
                                <div class="ranking-actions" style="display: flex; gap: 8px;">
                                    <span class="btn"
                                        style="background: #FAC00B; color: #000000; border: none; font-weight: 700; pointer-events: none;">
                                        🗳️ {{ $video->votos_count ?? 0 }} votos
                                    </span>
                                    <span class="btn"
                                        style="background: #1E484B; color: #ffffff; border: none; font-weight: 700; pointer-events: none;">
                                        👍 {{ $video->favoritos_count  ?? 0 }} me gusta
                                    </span>
                                    <span class="btn"
                                        style="background: #1E484B; color: #ffffff; border: none; font-weight: 700; pointer-events: none;">
                                        💬 {{ $video->comentarios_count ?? 0 }} comentarios
                                    </span>
                                </div>
                            </div>


                        </div>
                    @endforeach
                </div>
            @endforeach

            <!-- Modal -->
            <div id="videoModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <div id="videoHeader" class="mb-4 text-center font-bold text-lg text-[#1E484B]"></div>
                    <div id="videoContainer" class="text-center"></div>
                </div>
            </div>
        </div> <!-- cierre animated-bg -->
    </div> <!-- cierre ranking-fondo -->


    <script>
        function openModal(videoUrl, titulo = '', participante = '') {
            const modal = document.getElementById('videoModal');
            const container = document.getElementById('videoContainer');
            const header = document.getElementById('videoHeader');

            header.innerText = `${titulo} — ${participante}`;
            container.innerHTML = `<iframe width="100%" height="450" src="${videoUrl}" frameborder="0" allowfullscreen></iframe>`;
            modal.style.display = "block";
        }

        function closeModal() {
            const modal = document.getElementById('videoModal');
            const container = document.getElementById('videoContainer');
            const header = document.getElementById('videoHeader');

            modal.style.display = "none";
            container.innerHTML = "";
            header.innerText = "";
        }

        window.onclick = function (event) {
            const modal = document.getElementById('videoModal');
            if (event.target == modal) closeModal();
        };
        /* Mostrar ranking por concurso */
        function mostrarRanking(id, boton) {
            document.querySelectorAll('.ranking-concurso').forEach(div => div.classList.remove('active'));
            const seleccionado = document.getElementById('ranking-' + id);
            if (seleccionado) seleccionado.classList.add('active');

            document.querySelectorAll('.concurso-btn').forEach(btn => btn.classList.remove('active'));
            if (boton) boton.classList.add('active');
        }
    </script>


@endsection
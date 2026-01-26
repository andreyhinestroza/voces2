<style>
  .sidebar-btn {
    font-family: 'Montserrat', sans-serif;
    background: linear-gradient(to bottom, #e0e0e0, #cfcfcf);
    color: #1E484B;
    border: 2px solid #00A06E;
    border-radius: 12px;
    padding: 10px 16px;
    font-weight: 500;
    text-align: center;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    display: block;
    text-decoration: none;
  }

  .sidebar-btn:hover {
    background: linear-gradient(to bottom, #00A06E, #00905f);
    color: white;
    transform: scale(1.02);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
  }

  .sidebar-btn.active {
    background: linear-gradient(to bottom, #00A06E, #00905f);
    color: white;
    font-weight: bold;
    box-shadow: inset 0 0 0 2px #FAC00B;
  }
</style>

<h5 class="mt-3 ms-3" style="font-family:Montserrat;">🎧 USUARIO</h5>
<ul class="list-group list-group-flush mb-4">
  <li class="list-group-item"><i class="fas fa-user me-2"></i>{{ auth()->user()->nombre }}</li>
</ul>

<h6 class="ms-3" style="font-family:Montserrat;">👤 Mi cuenta</h6>
<div class="d-grid gap-3 p-3">
  <a href="{{ route('comunidad') }}" class="sidebar-btn {{ request()->routeIs('comunidad') ? 'active' : '' }}">
    🗳️ Votaciones
  </a>


  <a href="{{ route('listas.reproduccion') }}" class="sidebar-btn {{ request()->routeIs('listas.reproduccion') ? 'active' : '' }}">
    🎵 Lista de reproducción
  </a>
  <a href="{{ route('videos.megustan') }}" class="sidebar-btn {{ request()->routeIs('videos.megustan') ? 'active' : '' }}">
    👍 Videos que me gustan
  </a>
  <a href="{{ route('videos.votados') }}" class="sidebar-btn {{ request()->routeIs('videos.votados') ? 'active' : '' }}">
    🗳️ Videos votados
  </a>
</div>

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

  .sidebar-header {
    color: white;
    font-family: Montserrat;
    font-size: 1.1rem;
    margin-bottom: 1rem;
  }

  .sidebar-account {
    background-color: white;
    color: #1E484B;
    font-family: Montserrat;
    font-weight: bold;
    padding: 10px 15px;
    border-radius: 12px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .sidebar-account i {
    color: #1E484B;
  }

</style>

<h5 class="mt-3 ms-3" style="font-family:Montserrat; color:white;">🎧 Usuario</h5>

<div class="mx-3 mb-4 p-2 rounded d-flex align-items-center justify-content-center" style="background-color:white;">
  <span style="color:#1E484B; font-weight:bold; font-family:Montserrat;">
    <i class="fas fa-user me-2" style="color:#1E484B;"></i>{{ auth()->user()->nombre }}
  </span>
</div>

<h6 class="ms-3" style="font-family:Montserrat; color:white;">
  <i class="fas fa-user" style="color:white;"></i>  Mi cuenta
</h6>


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

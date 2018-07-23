<!--Navbar-->
<nav class="navbar navbar-dark bg-dark">
  <div class="container d-flex justify-content-between">
     <!-- Navbar brand -->
    <a href="/" class="navbar-brand">Inicio</a>
    @guest

    @else
    <a href="#" class="navbar-brand">{{ Auth::user()->name }}</a>
    @endguest
    <!-- Collapse button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="navbarHeader">  
     <ul class="navbar-nav ml-auto">
      <!-- Authentication Links -->
      @guest
      <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}</a>
      </li>
      @else
      <li class="nav-item">
        <a class="nav-link" href="/perfil" >{{ __('Perfil') }}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/registerTrip" >Dar Aventon!</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/Trips" >Buscar Aventon</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="/Trips/Organized">Mis Aventones Organizados</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/registerVehicle" >Agregar Vehiculo</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                         {{ __('Cerrar sesión') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
      </li>    
      @endguest
     </ul>
    </div>
  </div> 
</nav>
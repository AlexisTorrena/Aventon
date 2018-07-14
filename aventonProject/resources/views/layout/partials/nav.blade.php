<div class="navbar navbar-dark bg-dark">
  <div class="container d-flex justify-content-between">
    <a href="/" class="navbar-brand">Inicio</a>
    <ul class="navbar-nav ml-auto">
      <!-- Authentication Links -->
      @guest
      <ul class="nav justify-content-end">
            <li class="nav-item">
              <a  class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link">|</a>
            </li>
            <li class="nav-item">
              <a  class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}</a>
            </li>
      </ul>
      @else
      <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false" v-pre>
                  {{ Auth::user()->name }} <span class="caret"></span>
                </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/perfil" ><i class="fas fa-user-circle"></i> {{ __('Perfil') }}</a>
          <a class="dropdown-item" href="registerTrip" ><i class="fas fa-plus"></i> Dar Aventon!</a>
          <a class="dropdown-item" href="Trips" ><i class="fas fa-search" ></i> Buscar Aventon  </a>
          <a class="dropdown-item" href="registerVehicle" > <i class="fas fa-car"></i> Agregar Vehiculo</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> {{ __('Cerrar sesión') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </li>
      </ul>
      @endguest
    </ul>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader"
      aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
  </div>
</div>

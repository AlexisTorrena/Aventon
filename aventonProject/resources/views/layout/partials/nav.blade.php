<div class="navbar navbar-dark bg-dark">
  <div class="container d-flex justify-content-between">
    <a href="/" class="navbar-brand">Inicio</a>
    <ul class="navbar-nav ml-auto">
      <!-- Authentication Links -->
      @guest
      <a class="nav-brand" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
      <a class="nav-brand" href="{{ route('register') }}">{{ __('Registrar') }}</a> @else
      <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false" v-pre>
                  {{ Auth::user()->name }} <span class="caret"></span>
                </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                         {{ __('Cerrar sesión') }}
                    </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </li>
      @endguest
    </ul>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader"
      aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
  </div>
</div>
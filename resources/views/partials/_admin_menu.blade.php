<nav>
  <div class="container">
    <div class="nav-wrapper red">
      <a href="/" class="brand-logo center">Quick User</a>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </div>
</nav>
<ul class="side-nav fixed" id="nav-mobile">
  <li>
    <div class="user-view">
      <div class="background blue">
      </div>
      <a href="#!user"><img class="circle" src="{{ asset('images/ninja.png') }}"></a>
      <a href="#!name"><span class="white-text name">{{ auth()->user()->name }}</span></a>
      <a href="#!email"><span class="white-text email">{{ auth()->user()->email }}</span></a>
    </div>
  </li>
  <li>
    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="material-icons left">power_settings_new</i>Cerrar Sesión</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
  </li>
  <li><div class="divider"></div></li>
  <li><a class="subheader">Gestión de Usuarios</a></li>
  <li><a class="waves-effect" href="#!">Usuarios</a></li>
</ul>

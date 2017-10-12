<nav>
  <div class="container">
    <div class="nav-wrapper red">
      <a href="/home" class="brand-logo center">Quick User</a>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </div>
</nav>
<ul class="side-nav fixed" id="nav-mobile">
  <li>
    <div class="user-view">
      <div class="background blue">
      </div>
      <a href="{{ route('user_profile_path', auth()->user()->id) }}"><img class="circle" src="{{ asset('images/ninja.png') }}"></a>
      <a href="{{ route('user_profile_path', auth()->user()->id) }}"><span class="white-text name">{{ auth()->user()->name }}</span></a>
      <a href="{{ route('user_profile_path', auth()->user()->id) }}"><span class="white-text email">{{ auth()->user()->email }}</span></a>
    </div>
  </li>
  <li>
    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="material-icons left red-text">power_settings_new</i>Cerrar Sesión</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
  </li>
  <li><div class="divider"></div></li>
  <li><a class="subheader">Gestión de Usuarios</a></li>
  @can ('access_users_list', auth()->user())
    <li><a class="waves-effect" href="{{ route('users_path') }}"><i class="material-icons left">group</i>Usuarios</a></li>
  @endcan
</ul>

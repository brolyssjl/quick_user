<nav>
  <div class="nav-wrapper red">
    <a href="/" class="brand-logo center">Quick User</a>
    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
      @guest
        <li><a href="{{ route('login') }}"><i class="material-icons left">person</i>Iniciar Sesión</a></li>
        <li><a href="{{ route('register') }}"><i class="material-icons left">person_add</i>Registrarse</a></li>
      @endguest
    </ul>
    <ul class="side-nav" id="mobile-demo">
      @guest
        <li><a href="{{ route('login') }}"><i class="material-icons left">person</i>Iniciar Sesión</a></li>
        <li><a href="{{ route('register') }}"><i class="material-icons left">person_add</i>Registrarse</a></li>
      @endguest
    </ul>
  </div>
</nav>

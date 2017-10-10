@extends('layouts.app')
@section('navbar')
  @include('partials._menu')
@endsection
@section('content')
  <div class="container container-login">
    <div class="row mt-50">
      <div class="col s12">
        <form action="{{ route('login') }}" method="post">
          {{ csrf_field() }}
          <div class="row">
            <div class="input-field col s12 center">
              <h5>Iniciar Sesión</h5>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">perm_identity</i>
              <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required>
              <label for="email" data-error="Email inválido" data-success="Ok">Email</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">lock_outline</i>
              <input id="password" type="password" name="password" required>
              <label for="password">Password</label>
            </div>
          </div>
          <p class="check-remember">
            <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember">Recordarme</label>
          </p>
          <div class="row">
            <div class="input-field col s12">
              <button class="btn waves-effect waves-light col s12" type="submit">Iniciar Sesión
                <i class="material-icons right">send</i>
              </button>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6 m6 l6">
              <p class="margin left-align medium-small"><a href="{{ route('password.request') }}">Olvidó la contraseña?</a></p>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

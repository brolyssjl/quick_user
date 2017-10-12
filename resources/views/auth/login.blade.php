@extends('layouts.app')
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
          @if (session('auth_error'))
            <div class="invalid-feedback">
              {{ session('auth_error') }}
            </div>
          @endif
          @if (session('verification_message'))
            <div class="invalid-feedback green-text">
              {{ session('verification_message') }}
            </div>
          @endif
          <div class="row">
            @if ($errors->has('email'))
              @foreach ($errors->get('email') as $error)
                <div class="invalid-feedback">
                  {{ $error }}
                </div>
              @endforeach
            @endif
            <div class="input-field col s12">
              <i class="material-icons prefix">perm_identity</i>
              <input id="email" type="email" class="validate @if($errors->has('email'))invalid @endif" name="email" value="{{ old('email') }}" required>
              <label for="email" data-error="Email inválido" data-success="Ok">Email</label>
            </div>
          </div>
          <div class="row">
            @if ($errors->has('password'))
              @foreach ($errors->get('password') as $error)
                <div class="invalid-feedback">
                  {{ $error }}
                </div>
              @endforeach
            @endif
            <div class="input-field col s12">
              <i class="material-icons prefix">lock_outline</i>
              <input id="password" type="password" name="password" class="validate @if($errors->has('password'))invalid @endif" required>
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
            <div class="input-field col s12">
              <a href="{{ route('facebook_auth') }}" class="btn waves-effect waves-light col s12 blue darken-4">Iniciar Sesión con Facebook<i class="material-icons right">send</i></a>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6 m6 l6">
              <p class="margin left-align medium-small"><a href="{{ route('password.request') }}">Olvidó la contraseña?</a></p>
            </div>
            <div class="input-field col s6 m6 l6">
              <p class="margin right-align medium-small"><a href="{{ route('register') }}">No tienes cuenta?</a></p>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

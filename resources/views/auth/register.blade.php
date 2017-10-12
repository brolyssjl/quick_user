@extends('layouts.app')
@section('content')
  <div class="container container-register">
    <div class="row mt-50">
      <div class="col s12">
        <form action="{{ route('register') }}" method="post">
          {{ csrf_field() }}
          <div class="row">
            <div class="input-field col s12 center">
              <h5>Crear Cuenta</h5>
            </div>
          </div>
          <div class="row">
            @if ($errors->has('name'))
              @foreach ($errors->get('name') as $error)
                <div class="invalid-feedback">
                  {{ $error }}
                </div>
              @endforeach
            @endif
            <div class="input-field col s12">
              <i class="material-icons prefix">account_circle</i>
              <input id="name" type="text" name="name" value="{{ old('name') }}" class="validate @if($errors->has('name')) invalid @endif">
              <label for="name">Nombre</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">phone</i>
              <input id="phone_number" name="phone_number" value="{{ old('phone_number') }}" type="tel" class="validate">
              <label for="phone_number">Teléfono</label>
            </div>
          </div>
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
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">lock_outline</i>
              <input id="password-confirmation" type="password" name="password_confirmation" class="validate @if($errors->has('password'))invalid @endif" required>
              <label for="password-confirmation">Confirmar Constraseña</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <button class="btn waves-effect waves-light col s12" type="submit">Registrarse<i class="material-icons right">send</i></button>
            </div>
          </div>
          <!--<div class="row">
            <div class="input-field col s6 m6 l6">
              <p class="margin left-align medium-small"><a href="">Registro con Facebook</a></p>
            </div>
          </div>-->
        </form>
      </div>
    </div>
  </div>
@endsection

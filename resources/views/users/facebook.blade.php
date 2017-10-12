@extends('layouts.app')
@section('content')
  <div class="container container-login">
    <div class="row mt-50">
      <div class="col s12">
        <form action="/auth/facebook/register" method="post">
          {{ csrf_field() }}
          <div class="row">
            <div class="input-field col s12 center">
              <h5>Registrarse con Facebook</h5>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">account_circle</i>
              <input id="name" type="text" class="validate" value="{{ $user->email }}" readonly>
              <label for="name">Nombre</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">phone</i>
              <input id="phone-number" name="phone_number" type="tel" class="validate">
              <label for="phone-number">Teléfono</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">perm_identity</i>
              <input id="email" type="email" class="validate" value="{{ $user->email }}" readonly>
              <label for="email">Email</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <button class="btn waves-effect waves-light col s12" type="submit">Registrarse<i class="material-icons right">send</i></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

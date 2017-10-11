@extends('layouts.ums')
@section('content')
  <h2>Nuevo Usuario</h2>
  <form action="{{ route('create_user_path') }}" method="post">
    {{ csrf_field() }}
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
      @if ($errors->has('phone_number'))
        @foreach ($errors->get('phone_number') as $error)
          <div class="invalid-feedback">
            {{ $error }}
          </div>
        @endforeach
      @endif
      <div class="input-field col s12">
        <i class="material-icons prefix">phone</i>
        <input id="phone_number" name="phone_number" value="{{ old('phone_number') }}" type="tel" class="validate @if($errors->has('phone_number')) invalid @endif">
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
        <i class="material-icons prefix">email</i>
        <input id="email" type="email" name="email" value="{{ old('email') }}" class="validate @if($errors->has('email'))invalid @endif">
        <label for="email">Email</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <select name="role_id">
          <option value="" disabled selected>Seleccione el rol...</option>
          @foreach ($roles as $role)
            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
          @endforeach
        </select>
        <label>Rol del usuario</label>
      </div>
    </div>
    <p class="check-remember">
      <input type="checkbox" @if(old('check_random_pass')) checked @endif id="check-random-pass" name="check_random_pass" value="1" v-on:click="disabledInput($event)">
      <label for="check-random-pass">Contraseña aleatoria</label>
    </p>
    <div class="row">
      @if ($errors->has('password'))
        @foreach ($errors->get('password') as $error)
          <div class="invalid-feedback">
            {{ $error }}
          </div>
        @endforeach
      @endif
      <div class="input-field col s12">
        <i class="material-icons prefix">lock</i>
        <input id="password" type="password" name="password" @if(old('check_random_pass')) disabled @endif class="validate @if($errors->has('password'))invalid @endif">
        <label for="password">Contraseña</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">lock</i>
        <input id="confirm-password" type="password" name="confirm_password" @if(old('check_random_pass')) disabled @endif class="validate @if($errors->has('password'))invalid @endif">
        <label for="confirm-password">Confirmar Contraseña</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <button type="submit" class="btn waves-effect waves-light right">Crear Usuario<i class="material-icons right">send</i></button>
      </div>
    </div>
  </form>
@endsection

@extends('layouts.ums')
@section('content')
  <h2>@if (auth()->user()->id == $user->id) Mis ajustes @else Editar Usuario @endif</h2>
  <form action="{{ route('edit_user_path', $user->id) }}" method="post">
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
        <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" class="validate @if($errors->has('name')) invalid @endif">
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
        <input id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" type="tel" class="validate @if($errors->has('phone_number')) invalid @endif">
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
        <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" class="validate @if($errors->has('email'))invalid @endif">
        <label for="email">Email</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <select name="role_id">
          <option value="" disabled selected>Seleccione el rol...</option>
          @foreach ($roles as $role)
            @if ($user->role_id == $role->id)
              <option value="{{ $role->id }}" selected>{{ $role->role_name }}</option>
            @else
              <option value="{{ $role->id }}">{{ $role->role_name }}</option>
            @endif
          @endforeach
        </select>
        <label>Rol del usuario</label>
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
        <i class="material-icons prefix">lock</i>
        <input id="password" type="password" name="password" class="validate @if($errors->has('password'))invalid @endif">
        <label for="password">Contraseña</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">lock</i>
        <input id="confirm-password" type="password" name="confirm_password" class="validate @if($errors->has('password'))invalid @endif">
        <label for="confirm-password">Confirmar Contraseña</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        @if ($user->actived)
          <a href="{{ route('disable_user', $user->id) }}" class="btn waves-effect waves-light red left">Desactivar Usuario<i class="material-icons right">send</i></a>
        @else
          <a href="{{ route('active_user', $user->id) }}" class="btn waves-effect waves-light green left">Activar Usuario<i class="material-icons right">send</i></a>
        @endif
        <button type="submit" class="btn waves-effect waves-light right">Actualizar Usuario<i class="material-icons right">send</i></button>
      </div>
    </div>
  </form>
@endsection

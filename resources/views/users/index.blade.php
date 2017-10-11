@extends('layouts.ums')
@section('content')
  <div class="section">
  <h4 class="red-text">Listado de usuarios</h4>
</div>
<div class="section">
  <ul class="collapsible popout" data-collapsible="accordion">
    @foreach ($users as $user)
      <li>
        <div class="collapsible-header white-text text-bold @if($user->actived)red @else grey @endif">
          <div><i class="material-icons">person</i>{{ $user->name }}</div>
          <div>{{ $user->role->role_name }}</div>
          <div>@if($user->actived) Activo desde {{ date_format($user->created_at, 'd/m/Y') }}@else Desactivado @endif</div>
        </div>
        <div class="collapsible-body">
          <span><strong>Email:</strong> {{ $user->email }} - <strong>Teléfono de contacto:</strong> {{ $user->phone_number }}</span>
          <div class="section">
            <a href="{{ route('edit_user_path', $user->id) }}" data-position="left" data-delay="50" data-tooltip="Editar Usuario" class="btn-floating btn-large waves-effect waves-light tooltipped"><i class="material-icons">edit</i></a>
            <a href="#" data-position="right" data-delay="50" data-tooltip="Borrar Usuario" class="btn-floating btn-large waves-effect waves-light tooltipped" v-on:click.prevent="deleteUser($event)">
              <i class="material-icons">delete</i>
              <form action="{{ route('delete_user_path', $user->id) }}" method="POST" style="display: none;">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
              </form>
            </a>
          </div>
        </div>
      </li>
    @endforeach
  </ul>

  @if (count($users))
    {{ $users->links() }}
  @endif
</div>

@if (session('success'))
  <alert message="{{ session('success') }}"></alert>
@endif

<!-- Create User -->
<div class="fixed-action-btn">
  <a href="{{ route('create_user_path') }}" class="btn-floating btn-large tooltipped" data-position="left" data-delay="50" data-tooltip="Crear Usuario">
    <i class="large material-icons">add</i>
  </a>
</div>
@endsection

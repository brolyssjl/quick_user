@extends('layouts.app')
@section('content')
  <div class="container">
    @if (session('message'))
      <p class="flow-text center">{{ session('message') }}</p>
    @else
      <h1 class="center">Bienvenido a Quick User</h1>
      <p class="flow-text center">Su mejor opción para gestionar sus usuarios!</p>
    @endif
  </div>
@endsection

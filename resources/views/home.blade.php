@extends('layouts.ums')
@section('content')
  <p class="flow-text">Bienvenido {{ auth()->user()->name }}! :)</p>
@endsection

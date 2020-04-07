@extends("theme.$theme.layout")
@section('titulo')
Sistema Menus
@endsection()


@section('contenido')
<div id="app">
  @include('includes.form-error')
  @include('includes.mensaje')
  @csrf
  <cita></cita>
  
</div>
@endsection()
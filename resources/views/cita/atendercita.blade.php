@extends("theme.$theme.layout")
@section('titulo')
Atender Citas
@endsection()
@section('contenido')
<div id="app">
  @include('includes.form-error')
  @include('includes.mensaje')
  @csrf
  <atendercita></atendercita>  
</div>
@endsection()
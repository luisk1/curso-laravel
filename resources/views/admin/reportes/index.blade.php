@extends("theme.$theme.layout")
@section('titulo')
Sistema Reportes
@endsection()


@section('contenido')

<div id="app">
  @include('includes.form-error')
  @include('includes.mensaje')
  @csrf
  <reportes></reportes>  
</div>

@endsection()
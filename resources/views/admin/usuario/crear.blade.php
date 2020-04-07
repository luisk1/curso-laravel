@extends("theme.$theme.layout")
@section('titulo')
Gestionar Usuario
@endsection()

@section('contenido')

<div id="app">
  @include('includes.form-error')
  @include('includes.mensaje')
  @csrf
  <crearusu></crearusu>  
</div>
@endsection()

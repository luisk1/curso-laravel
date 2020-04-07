@extends("theme.$theme.layout")
@section('titulo')
Sistema Ordenes de Compra X cita
@endsection()


@section('contenido')

<style>
  html, body {
      background-color: #fff;
      color: #636b6f;
      font-family: 'Raleway', sans-serif;
      font-weight: 100;
      height: auto;
      margin: 0;
  }
  .full-height {
      min-height: 100vh;
  }
  .flex-center {
      align-items: center;
      display: flex;
      justify-content: center;
  }
  .position-ref {
      position: relative;
  }
  .top-right {
      position: absolute;
      right: 10px;
      top: 18px;
  }
  .content {
  /*  text-align: center; */
  }
  .title {
      font-size: 84px;
  }
  .m-b-md {
      margin-bottom: 30px;
  }
  .modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, .5);
    display: table;
    transition: opacity .3s ease;
  }
  .modal-wrapper {
    display: table-cell;
    vertical-align: middle;
  }
  .modal-container {
    width: 300px;
    margin: 0px auto;
    padding: 20px 30px;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
    transition: all .3s ease;
    font-family: Helvetica, Arial, sans-serif;
  }
  .modal-header h3 {
    margin-top: 0;
    color: #42b983;
  }
  .modal-body {
    margin: 20px 0;
  }
  </style>
<div id="app">
  @include('includes.form-error')
  @include('includes.mensaje')
  @csrf
  <ordencita></ordencita>  
</div>

@endsection()
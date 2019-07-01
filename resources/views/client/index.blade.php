@extends('admin.layout')

@section('adminlte_css')
  <meta name="csrf-token" = content="{{ csrf_token() }}">
@stop

@section('content-header')
  <h1>
    Clientes
  </h1>
@stop

@section('content')
      <h2>Lista de Clientes</h2>

      <a class="btn btn-success btn-md addNew" style="float: right;" href="{{ url('client/create') }}"><b>Agregar Nuevo</b></a><br><br>

      <div class="box-body">
          <table id="clients_table" class="table table-striped table-bordered" style="width:100%">
          <thead>
              <tr>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Celular</th>
                  <th>Teléfono Fijo</th>
                  <th>Direccion</th>

                  <th width="120px">Acciones</th>
              </tr>
          </thead>
      </table>
      </div>
      @include('client.modal')
@stop

@section('adminlte_js')
@include('client.partials.script')
@stop

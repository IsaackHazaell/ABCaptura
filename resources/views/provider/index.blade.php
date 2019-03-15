@extends('admin.layout')

@section('adminlte_css')
  <meta name="csrf-token" = content="{{ csrf_token() }}">
@stop

@section('content-header')
  <h1>
    Proveedores
  </h1>
@stop

@section('content')
      <h2>Lista de Proveedores</h2>

      <a class="btn btn-success btn-md addNew" style="float: right;" href="{{ url('provider/create') }}"><b>Agregar Nuevo</b></a><br><br>

      <div class="box-body">
          <table id="providers_table" class="table table-striped table-bordered" style="width:100%">
          <thead>
              <tr>
                  <th width="10px">Id</th>
                  <th>Nombre</th>
                  <th>Categoría</th>
                  <th>Giro</th>
                  <th>Teléfono 1</th>
                  <th>Correo</th>
                  <th width="120px">Acciones</th>
              </tr>
          </thead>
      </table>
      </div>
      @include('provider.modal')
@stop

@section('adminlte_js')
@include('provider.partials.script')
@stop

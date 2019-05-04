@extends('admin.layout')

@section('adminlte_css')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <meta name="csrf-token" = content="{{ csrf_token() }}">
@stop

@section('content-header')
  <h1>
    Obras
  </h1>
@stop

@section('content')
      <h2>Lista de Obras</h2>

      <a class="btn btn-success btn-md addNew" style="float: right;" href="{{ url('construction/create') }}"><b>Agregar Nuevo</b></a><br><br>

      <div class="box-body">
          <table id="constructions_table" class="table table-striped table-bordered" style="width:100%">
          <thead>
              <tr>
                  <th width="10px">Id</th>
                  <th>Nombre</th>
                  <th>Porcentaje de Honorario</th>
                  <th>Fecha de Arranque</th>
                  <th>Metros cuadrados</th>
                  <th>Estatus</th>
                  <th width="100px">Acciones</th>
              </tr>
          </thead>
      </table>
      </div>
      @include('construction.modal')
@stop

@section('adminlte_js')
@include('construction.partials.script')
@stop

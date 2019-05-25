@extends('admin.layout')

@section('adminlte_css')
  <meta name="csrf-token" = content="{{ csrf_token() }}">
@stop

@section('content-header')
  <h1>
    Capturas
  </h1>
@stop

@section('content')
      <h2>Lista de Capturas</h2>

      <a class="btn btn-success btn-md addNew" style="float: right;" href="{{ url('capture/create') }}"><b>Crear captura</b></a><br><br>

      <div class="box-body">
          <table id="capture_table" class="table table-striped table-bordered" style="width:100%">
          <thead>
              <tr>
                  <th>Obra</th>
                  <th>Proveedor</th>
                  <th>Fecha</th>
                  <th>Concepto</th>
                  <th>Total</th>
                  <th>Comprobante</th>
                  <th width="120px">Acciones</th>
              </tr>
          </thead>
      </table>
      </div>
@stop

@section('adminlte_js')
    @include('capture.partials.script_index')
@stop

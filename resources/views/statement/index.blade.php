@extends('admin.layout')

@section('adminlte_css')
  <meta name="csrf-token" = content="{{ csrf_token() }}">
@stop

@section('content-header')
  <h1>
    Estados de cuenta
  </h1>
@stop

@section('content')
      <h2>Lista de Estados de cuenta</h2>

      <a class="btn btn-success btn-md addNew" style="float: right;" href="{{ url('statement/create') }}"><b>Agregar Nuevo</b></a><br><br>

      <div class="box-body">
          <table id="statements_table" class="table table-striped table-bordered" style="width:100%">
          <thead>
              <tr>
                  <!-- <th width="10px">Id</th> -->
                  <th>Obra</th>
                  <th>Proveedor</th>
                  <th>Estatus</th>
                  <th>Total</th>
                  <th>Restante</th>
                  <th width="120px">Acciones</th>
              </tr>
          </thead>
      </table>
      </div>
      @include('statement.modal')
@stop

@section('adminlte_js')
@include('statement.partials.script')
@stop

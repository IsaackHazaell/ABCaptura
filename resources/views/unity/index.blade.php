@extends('admin.layout')

@section('adminlte_css')
  <meta name="csrf-token" = content="{{ csrf_token() }}">
@stop

@section('content-header')
  <h1>
    Unidad
  </h1>
@stop

@section('content')
      <h2>Lista de Unidades</h2>

      <a class="btn btn-success btn-md addNew" style="float: right;" href="{{ url('unity/create') }}"><b>Agregar Nuevo</b></a><br><br>

      <div class="box-body">
          <table id="unity_table" class="table table-striped table-bordered" style="width:100%">
          <thead>
              <tr>
                  <th width="10px">Id</th>
                  <th>Nombre</th>
                  <th>Referencia</th>
                  <th>Equivalente</th>
                  <th width="120px">Acciones</th>
              </tr>
          </thead>
      </table>
      </div>
      @include('unity.modal')
@stop

@section('adminlte_js')
@include('unity.partials.script')
@stop

@extends('admin.layout')

@section('adminlte_css')
  <meta name="csrf-token" = content="{{ csrf_token() }}">
@stop

@section('content-header')
  <h1>
    Productos
  </h1>
@stop

@section('content')
      <h2>Lista de Productos</h2>

      <a class="btn btn-success btn-md addNew" style="float: right;" href="{{ url('product/create') }}"><b>Agregar Nuevo</b></a><br><br>

      <div class="box-body">
          <table id="products_table" class="table table-striped table-bordered" style="width:100%">
          <thead>
              <tr>
                  <th width="10px">Id</th>
                  <th>Concepto</th>
                  <th>Descripción</th>
                  <th>Proveedor</th>
                  <th>Categoría</th>
                  <th width="120px">Acciones</th>
              </tr>
          </thead>
      </table>
      </div>

@stop

@section('adminlte_js')
@include('product.partials.script')
@stop

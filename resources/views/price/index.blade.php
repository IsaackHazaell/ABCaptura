@extends('admin.layout')

@section('adminlte_css')
  <meta name="csrf-token" = content="{{ csrf_token() }}">
@stop

@section('content-header')
  <h1>
    Precios
  </h1>
@stop

@section('content')
      <h2>Lista de Precios</h2>

      <a class="btn btn-success btn-md addNew" style="float: right;" href="{{ url('price/create') }}"><b>Agregar Nuevo</b></a><br><br>

      <div class="box-body">
          <table id="prices_table" class="table table-striped table-bordered" style="width:100%">
          <thead>
              <tr>
                  <th width="10px">Id</th>
                  <th>Obra</th>
                  <th>Concepto</th>
                  <th>Unidad</th>
                  <th>Precio</th>
                  <th>Año</th>
                  <th width="120px">Acciones</th>
              </tr>
          </thead>
      </table>
      </div>
      @include('price.modal', ['constructions' => $constructions, 'products' => $products, 'unities' => $unities])
@stop

@section('adminlte_js')
@include('price.partials.script')
@stop

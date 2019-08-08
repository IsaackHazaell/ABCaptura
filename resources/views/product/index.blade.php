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
      <div class="col-md-10">
        <div class="col-md-4">
          <label for="providers">Proveedor</label>
            <select class="form-control" name="providers" id="providers" onchange="countProducts()">
                @foreach ($providers as $provider)
                <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                
                @endforeach
              </select>
        </div>
        <div class="col-md-4">
          <label for="count">Cantidad de productos</label>
            <input class="form-control" type="number" name="count" id="count" readonly>
        </div>

        
      </div>
      <div class="col-md-12">
          <a class="btn btn-success btn-md addNew" style="float: right;" href="{{ url('product/create') }}"><b>Agregar Nuevo</b></a><br><br>
      </div>
      

      <div class="box-body">
          <table id="products_table" class="table table-striped table-bordered" style="width:100%">
          <thead>
              <tr>
                  <th width="10px">Id</th>
                  <th>Concepto</th>
                  <th>Unidad</th>
                  <th>Precio unitario sin IVA</th>
                  <th>Mes y año</th>
                  <th>Proveedor</th>
                  <th>Descripción</th>
                  <th width="120px">Acciones</th>
              </tr>
          </thead>
      </table>
      </div>
      @include('product.modal', ['providers' => $providers])
@stop

@section('adminlte_js')
    <script>
      $("#providers").select2();
    </script>
    @include('product.partials.script')
    @include('product.partials.script_filter')
@stop

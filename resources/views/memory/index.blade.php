@extends('admin.layout')

@section('adminlte_css')
  <meta name="csrf-token" = content="{{ csrf_token() }}">
@stop

@section('content-header')
  <h1>
    Memoria
  </h1>
@stop

@section('content')
      <h2>Memoria</h2>
      <h3>{{ $contruction->name }} - {{ $date }}</h3>
      <h4>Honorarios: %{{ $contruction->honorary }}</h4>

      <a class="btn btn-success btn-md addNew" style="float: right;" href="{{ url('capture/create') }}"><b>Crear captura</b></a><br><br>

      <div class="box-body">
          <table id="memory_table" class="table table-striped table-bordered" style="width:100%">
          <thead>
              <tr>
                  <th>Fecha</th>
                  <th>Proveedor</th>
                  <th>Concepto</th>
                  <th>Factura</th>
                  <th>Total</th>
                  <th>Folio</th>
              </tr>
          </thead>
      </table>
      </div>

      <div class="form-row">
          <div class="form-group col-md-6">
            <label for="total_memory">Total de memoria</label>
            <input type="text" class="form-control" name="total_memory" id="total_memory" readonly>
          </div>
      </div>
@stop

@section('adminlte_js')
    @include('memory.partials.script')
@stop

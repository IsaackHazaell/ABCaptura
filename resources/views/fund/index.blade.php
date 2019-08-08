@extends('admin.layout')

@section('adminlte_css')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <meta name="csrf-token" = content="{{ csrf_token() }}">
@stop

@section('content-header')
  <h1>
    Fondos
  </h1>
@stop

@section('content')
      <h2>Lista de Fondos</h2>
      <div class="col-md-10">
        <div class="col-md-4">
          <label for="providers">Obra</label>
            <select class="form-control" name="construction" id="construction">
              <option value="">Todos</option>
                @foreach ($constructions as $construction)
                <option value="{{ $construction->name }}">{{ $construction->name }}</option>
                
                @endforeach
              </select>
        </div>
        <div class="col-md-4">
          <label for="providers">Fecha</label>
            <select class="form-control" name="month" id="month">
              <option value="">Todos</option>
              <option value="January">Enero</option>
              <option value="February">Febrero</option>
              <option value="March">Marzo</option>
              <option value="April">Abril</option>
              <option value="May">Mayo</option>
              <option value="June">Junio</option>
              <option value="July">Julio</option>
              <option value="August">Agosto</option>
              <option value="September">Septiembre</option>
              <option value="October">Octubre</option>
              <option value="November">Noviembre</option>
              <option value="December">Diciembre</option>
              </select>
        </div>

        
      </div>
      <div class="col-md-12">
        <a class="btn btn-success btn-md addNew" style="float: right;" href="{{ url('fund/create') }}"><b>Agregar Nuevo</b></a><br><br>
      </div>

      <div class="box-body">
          <table id="funds_table" class="table table-striped table-bordered" style="width:100%">
          <thead>
              <tr>
                  
                  <th>Obra</th>
                  <th>Fecha</th>
                  <th>Restante del fondo</th>
                  <th>Total</th>
                  <th>Metodo</th>
                  <th width="120px">Acciones</th>
              </tr>
          </thead>
      </table>
      </div>
      @include('fund.modal')

@stop

@section('adminlte_js')
<script>
  $("#month").select2();
  $("#construction").select2();
</script>
@include('fund.partials.script')
@stop

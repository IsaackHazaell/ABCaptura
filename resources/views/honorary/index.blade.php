@extends('admin.layout')

@section('adminlte_css')
  <meta name="csrf-token" = content="{{ csrf_token() }}">
@stop

@section('content-header')
  <h1>
    Honorarios
  </h1>
@stop

@section('content')
      <h3>{{ $construction->name }} ({{ $construction->honorary }}%)</h3>
        <h2>Por cobrar: {{ $honorary_remaining }}</h2>


      <div class="box-body">
          <table id="honoraries_table" class="table table-striped table-bordered" style="width:100%">
          <thead>
              <tr>
                  <th width="10px">Proveedor</th>
                  <th>Fecha de captura</th>
                  <th>Total de captura</th>
                  <th>Honorario</th>
                  <th>Estatus</th>
              </tr>
          </thead>
      </table>
      </div>
@stop

@section('adminlte_js')
  @include('honorary.partials.script')
@stop

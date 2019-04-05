@extends('admin.layout')
@section('content')

<section class="content-header">
  <h1>
    Captura
  </h1>
  <br>
  <p>Obra: {{$data->construction_id}} - Proveedor: {{$data->provider_id}}</p>
</section>

@include('capture.modal', ['provider' => $data->provider_id])

  <div class="form-row">
    <div class="form-group col-md-12">
      <button class="btn btn-success btn-md"
        data-toggle="modal" data-target="#addProduct" style="float: right;"><i class="fa fa-plus"></i> Crear producto</button>
    </div>
  </div>

  @include('capture.partials.form2')
    <div class="form-row">
      <div class="form-group col-md-12">
        <button id="prod" name="prod"  class="btn btn-info">Agregar producto</button>
      </div>
    </div>


<div class="box-body">
    <table id="products_capture_table" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th width="10px">Unidad</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Cargo extra</th>
            <th>Total</th>
            <th width="120px">Acciones</th>
        </tr>
    </thead>
</table>
</div>
@endsection

@section('adminlte_js')
@include('capture.partials.script')
@stop

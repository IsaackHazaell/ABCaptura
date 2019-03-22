@extends('admin.layout')
@section('content')

<section class="content-header">
  <h1>
    Captura
  </h1>
  <br>
  <p>Obra: {{$data->construction_id}} - Proveedor: {{$data->provider_id}}</p>
</section>

<form action="{{route('capture.create2')}}" >
  {{csrf_field()}}
  @include('capture.partials.form2')
    <div class="form-row">
      <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary">Agregar producto</button>
      </div>
    </div>
</form>

<div class="box-body">
    <table id="prices_table" class="table table-striped table-bordered" style="width:100%">
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

@extends('admin.layout')
@section('content')

<section class="content-header">
    <h1>Captura</h1>
    <br>
    <p>Obra: {{$data->construction_id}} - Proveedor: {{$data->provider_id}}</p>
</section>

<form action="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('capture.partials.form_material')
        <div class="form-row">
          <div class="form-group col-md-12">
            <button id="prod" name="prod"  class="btn btn-info">Añadir producto</button>
          </div>
    </div>

    <div class="box-body">
        <table id="edit_products_capture_table" class="table table-striped table-bordered" style="width:100%">
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

        <div class="form-row">
            @if($data->iva == 1)
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="subtotal_iva">Sub total sin iva</label>
                    <input type="number" class="form-control" required name="subtotal_iva" id="subtotal_iva" readonly>
                </div>
            </div>
            @endif
          <div class="form-group col-md-6">
            <label for="total">Total</label>
            <input type="number" readonly class="form-control" required name="total" id="total">
          </div>
        </div>
    </div>

</form>
<a class="btn btn-info btn-md" style="float: right;" href="{{ url('capture') }}"><b>Lista de Capturas</b></a><br><br>

@endsection

@section('adminlte_js')
    @include('capture.partials.script_edit_products')
    @include('capture.partials.script_iva')
@stop

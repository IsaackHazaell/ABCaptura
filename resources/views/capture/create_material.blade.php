@extends('admin.layout')
@section('content')

<section class="content-header">
    <h1>Captura</h1>
    <br>
    <p>Obra: {{$data->construction_id}} - Proveedor: {{$provider->name}}</p>
</section>

{{-- <form action="{{route('capture.saveProduct')}}" method="POST">
    {{csrf_field()}}
@include('capture.modal', ['provider' => $provider])

<div class="form-row">
    <div class="form-group col-md-12">
        <button class="btn btn-success btn-md"
            data-toggle="modal" data-target="#addProduct" style="float: right;"><i class="fa fa-plus"></i> Crear producto</button>
    </div>
</div>
</form> --}}

<form action="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('capture.partials.form_material')
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
          <div class="form-group col-md-6">
            <label for="fund_id">Seleccione el fondo</label>
            <select class="form-control" required name="fund_id" id="fund_id">
              @foreach($funds as $fund)
                  <option value={{$fund->id}}/{{$fund->remaining}}>{{$fund->id}} {{$fund->name}} - {{$fund->date}}</option>
              @endforeach
            </select>
          </div>
        </div>
        @include('capture.partials.form2')
    </div>
</form>
<button id="saveCapture" name="saveCapture" class="btn btn-success">Capturar</button>
@endsection

@section('adminlte_js')
    @include('capture.partials.script')
    @include('capture.partials.script_material')
    @include('capture.partials.script_iva')
@stop

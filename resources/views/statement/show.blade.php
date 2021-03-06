@extends('admin.layout')
@section('content')
@include('statement.modal')
<section class="content-header">
  <h1>
    Estado de cuenta
    <small>{{$statement->id}}</small>
  </h1>
  <br>
</section>

<div class="form-row">
    <div class="form-group col-md-6">
      <label for="construction_id">Obra</label>
      <input type="text" class="form-control" value="{{$construction->id}} {{$construction->name}}" readonly name="construction_id" id="construction_id">
    </div>
    <div class="form-group col-md-6">
      <label for="provider_id">Proveedor</label>
      <input type="text" class="form-control" value="{{$provider->id}} {{$provider->name}}" readonly name="provider_id" id="provider_id">
    </div>
    <div class="form-group col-md-6">
      <label for="status">Estatus</label>
      <input type="text" class="form-control" value="{{$statement->status}}" readonly name="status" id="status">
    </div>
    <div class="form-group col-md-6">
      <label for="total">Total</label>
      <input type="text" class="form-control" value="{{number_format($statement->total,2)}}" readonly name="total" id="total">
    </div>
    <div class="form-group col-md-6">
      <label for="remaining">Restante</label>
      <input type="text" class="form-control" value="{{number_format($statement->remaining,2)}}" readonly name="remaining" id="remaining">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-12">
      <button class="btn btn-success"

        data-idstatement="{{$statement->id}}"
        data-nameconstruction="{{$statement->construction_id}}"
        data-nameprovider="{{$statement->provider_id}}"
        data-statusstatement="{{$statement->status}}"
        data-remainingstatement="{{floatval(str_replace(",","",$statement->remaining))}}"
        data-totalstatement="{{floatval(str_replace(",","",$statement->total))}}"

        data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i>Editar</button>
        <a class="btn btn-primary btn-md addNew" style="float: right;" href="{{ url('statement') }}"><b>Lista de estados de cuenta</b></a>
    </div>
  </div>

  <div class="box-body">
      <table id="capture_table" class="table table-striped table-bordered" style="width:100%">
      <thead>
          <tr>
              <th>Fecha</th>
              <th>Concepto</th>
              <th>Total</th>
              <th>Comprobante</th>
              <th width="120px">Acciones</th>
          </tr>
      </thead>
  </table>
  </div>

@endsection

@section('adminlte_js')
@include('statement.partials.script')
@include('statement.partials.script_capture')
@endsection

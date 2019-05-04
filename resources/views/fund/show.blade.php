@extends('admin.layout')
@section('content')
@include('fund.modal')
<section class="content-header">
  <h1>
    Fondo
    <small>{{$fund->id}}</small>
  </h1>
</section>

<div class="form-row">
    <div class="form-group col-md-6">
      <label for="construction_id">Nombre</label>
      <input type="text" class="form-control" value="{{$fund->construction_id}}" readonly name="construction_id" id="construction_id">
    </div>
    <div class="form-group col-md-6">
      <label for="date">Fecha</label>
      <input type="text" class="form-control" value="{{$fund->date}}" readonly name="date" id="date">
    </div>
    <div class="form-group col-md-6">
      <label for="remaining">Restante de fondo</label>
      <input type="text" class="form-control" value="{{$fund->remaining}}" readonly name="remaining" id="remaining">
    </div>
    <div class="form-group col-md-6">
      <label for="total">Total</label>
      <input type="text" class="form-control" value="{{$fund->total}}" readonly name="total" id="total">
    </div>
</div>


  <div class="form-row">
    <div class="form-group col-md-12">
      <button class="btn btn-primary"
        data-idfund="{{$fund->id}}"
        data-construcion_id="{{$fund->construcion_id}}"
        data-date="{{$fund->date}}"
        data-remaining="{{$fund->remaining}}"
        data-total="{{$fund->total}}"
        data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i>Editar</button>
        <a class="btn btn-primary btn-md addNew" style="float: right;" href="{{ url('fund') }}"><b>Lista de fondos</b></a>
    </div>
  </div>
@endsection

@section('adminlte_js')
@include('fund.partials.script')
@endsection

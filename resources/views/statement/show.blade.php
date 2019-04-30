@extends('admin.layout')
@section('content')
@include('statement.modal')
<section class="content-header">
  <h1>
    Obras
    <small>{{$statement->id}}</small>
  </h1>
</section>

<div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">Nombre</label>
      <input type="text" class="form-control" value="{{$statement->name}}" readonly name="name" id="name">
    </div>
    <div class="form-group col-md-6">
      <label for="honorary">Honorario</label>
      <input type="number" class="form-control" value="{{$statement->honorary}}" readonly name="honorary" id="honorary">
    </div>
    <div class="form-group col-md-6">
      <label for="date">Fecha</label>
      <input type="date" class="form-control" value="{{$statement->date}}" readonly name="date" id="date">
    </div>
    <div class="form-group col-md-6">
      <label for="square_meter">Metros cuadrados</label>
      <input type="text" class="form-control" value="{{$statement->square_meter}}" readonly name="square_meter" id="square_meter">
    </div>
    <div class="form-group col-md-6">
      <label for="status">Giro</label>
      <input type="text" class="form-control" value="{{$statement->status}}" readonly name="status" id="status">
    </div>
  </div>

  @include('client.show')

  <div class="form-row">
    <div class="form-group col-md-12">
      <button class="btn btn-success"
        data-idstatement="{{$statement->id}}"
        data-namestatement="{{$statement->name}}"
        data-honorarystatement="{{$statement->honorary}}"
        data-datestatement="{{$statement->date}}"
        data-square_meterstatement="{{$statement->square_meter}}"
        data-statusstatement="{{$statement->status}}"

        data-client_name="{{$client->name}}"
        data-cellphone="{{$client->cellphone}}"
        data-phonelandline="{{$client->phonelandline}}"
        data-address="{{$client->address}}"

        data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i>Editar</button>
        <a class="btn btn-primary btn-md addNew" style="float: right;" href="{{ url('statement') }}"><b>Lista de obras</b></a>
    </div>
  </div>
@endsection

@section('adminlte_js')
@include('statement.partials.script')
@endsection

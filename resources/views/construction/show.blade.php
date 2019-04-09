@extends('admin.layout')
@section('content')
@include('construction.modal')
<section class="content-header">
  <h1>
    Obras
    <small>{{$construction->id}}</small>
  </h1>
</section>

<div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">Nombre</label>
      <input type="text" class="form-control" value="{{$construction->name}}" readonly name="name" id="name">
    </div>
    <div class="form-group col-md-6">
      <label for="honorary">Honorario</label>
      <input type="number" class="form-control" value="{{$construction->honorary}}" readonly name="honorary" id="honorary">
    </div>
    <div class="form-group col-md-6">
      <label for="date">Fecha</label>
      <input type="date" class="form-control" value="{{$construction->date}}" readonly name="date" id="date">
    </div>
    <div class="form-group col-md-6">
      <label for="square_meter">Metros cuadrados</label>
      <input type="text" class="form-control" value="{{$construction->square_meter}}" readonly name="square_meter" id="square_meter">
    </div>
    <div class="form-group col-md-6">
      <label for="status">Giro</label>
      <input type="text" class="form-control" value="{{$construction->status}}" readonly name="status" id="status">
    </div>
  </div>

  @include('client.show')

  <div class="form-row">
    <div class="form-group col-md-12">
      <button class="btn btn-primary"
        data-idconstruction="{{$construction->id}}"
        data-nameconstruction="{{$construction->name}}"
        data-honoraryconstruction="{{$construction->honorary}}"
        data-dateconstruction="{{$construction->date}}"
        data-square_meterconstruction="{{$construction->square_meter}}"
        data-statusconstruction="{{$construction->status}}"

        data-name="{{$client->client_name}}"
        data-cellphone="{{$client->cellphone}}"
        data-phonelandline="{{$client->phonelandline}}"
        data-address="{{$client->address}}"

        data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i>Editar</button>
        <a class="btn btn-primary btn-md addNew" style="float: right;" href="{{ url('construction') }}"><b>Lista de obras</b></a>
    </div>
  </div>
@endsection

@section('adminlte_js')
@include('construction.partials.script')
@endsection

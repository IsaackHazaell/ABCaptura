@extends('admin.layout')
@section('content')

<section class="content-header">

  <h1>
    Cliente
    <small>{{$client->id}}</small>
  </h1>
</section>

<div class="form-row">
  <div class="form-group col-md-6">
    <label for="name">Nombre</label>
    <input type="text" class="form-control" name="name" id="name" value="{{ $client->name }}" readonly>
  </div>
  <div class="form-group col-md-6">
    <label for="cellphone">Celular</label>
    <input type="text" class="form-control" name="cellphone" id="cellphone" value="{{ $client->cellphone }}" readonly>
  </div>
</div>

<div class="form-row">
  <div class="form-group col-md-6">
    <label for="email">Correo electrónico</label>
    <input type="text" class="form-control" name="email" id="email" value="{{ $client->email }}" readonly>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="phonelandline">Teléfono fijo</label>
      <input type="text" class="form-control" name="phonelandline" id="phonelandline" value="{{ $client->phonelandline }}" readonly>
    </div>
    <div class="form-group col-md-6">
      <label for="address">Domicilio</label>
      <input type="text" class="form-control" name="address" id="address" value="{{ $client->address }}" readonly>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-12">
      <br>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <button class="btn btn-primary"
        data-idclient="{{$client->id}}"
        data-nameclient="{{$client->name}}"
        data-phoneclient="{{$client->cellphone}}"
        data-phonelandlineclient="{{$client->phonelandline}}"
        data-emailclient="{{$client->email}}"
        data-addressclient="{{$client->address }}"
        data-toggle="modal" data-target="#edit">Editar</button>
    </div>

    <div class="form-group col-md-6">
      <a class="btn btn-primary btn-md addNew" style="float: right;" href="{{ url('client') }}"><b>Lista de clientes</b></a><br><br>
    </div>
  </div>
  @include('client.modal')
@endsection

@section('adminlte_js')
  @include('client.partials.script')
@stop

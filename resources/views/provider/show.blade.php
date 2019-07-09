@extends('admin.layout')
@section('content')
@include('provider.modal')
<section class="content-header">
  <h1>
    Proveedor
    <small>{{$provider->id}}</small>
  </h1>
</section>

<div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">Nombre</label>
      <input type="text" class="form-control" required name="name" id="name" value="{{$provider->name}}" readonly>
    </div>

    <div class="form-group col-md-6">
      <label for="category">Categoría</label>
      <input type="text" class="form-control" required name="category" id="category" value="{{$provider->category}}" readonly>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="turn">Giro</label>
      <input list="turns" class="form-control" required name="turn" id="turn" value="{{$provider->turn}}" readonly>
    </div>
    <div class="form-group col-md-6">
      <label for="company">Empresa</label>
      <input type="text" class="form-control" name="company" id="company" value="{{$provider->company}}" readonly>
    </div>

      </div>

<div class="form-row">
  <div class="form-group col-md-6">
    <label for="cellphone">Teléfono celular</label>
    <input type="text" class="form-control" required name="cellphone" id="cellphone" value="{{$provider->cellphone}}" readonly>
  </div>
  <div class="form-group col-md-6">
    <label for="phonlandline">Teléfono fijo</label>
    <input type="text" class="form-control" name="phonlandline" id="phonlandline" value="{{$provider->phonlandline}}" readonly>
  </div>
</div>

<div class="form-row">
      <div class="form-group col-md-6">
        <label for="mail">Correo</label>
        <input type="text" class="form-control" name="mail" id="mail" value="{{$provider->mail}}" readonly>
      </div>
</div>

  @include('address.show')

  <div class="form-row">
    <div class="form-group col-md-6">
      <button class="btn btn-success"
      data-idprovider="{{$provider->id}}"
      data-nameprovider="{{$provider->name}}"
      data-turnprovider="{{$provider->turn}}"
      data-categoryprovider="{{$provider->category}}"
      data-companyprovider="{{$provider->company}}"
      data-phoneprovider="{{$provider->cellphone}}"
      data-phonlandlineprovider="{{$provider->phonlandline}}"
      data-mailprovider="{{$provider->mail}}"

      data-streetprovider="{{$address->street}}"
      data-colonyprovider="{{$address->colony}}"
      data-townprovider="{{$address->town}}"
      data-stateprovider="{{$address->state}}"
        data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i>Editar</button>
    </div>

    <div class="form-group col-md-6">
      <a class="btn btn-primary btn-md addNew" style="float: right;" href="{{ url('provider') }}"><b>Lista de proveedores</b></a><br><br>
    </div>
  </div>
@endsection

@section('adminlte_js')
  @include('provider.partials.script')
@stop

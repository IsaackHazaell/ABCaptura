@extends('admin.layout')
@section('content')

<section class="content-header">
  <h1>
    Proveedor
    <small>Agregar Proveedor</small>
  </h1>
</section>

<form action="{{url('provider')}}" method="post">
  {{csrf_field()}}
  <div class="form-row">
      <div class="form-group col-md-6">
        <label for="name">Nombre</label>
        <input type="text" class="form-control" name="name" id="name">
      </div>
      <div class="form-group col-md-6">
        <label for="phone">Teléfono</label>
        <input type="number" class="form-control" name="phone" id="phone">
      </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
          <label for="mail">Correo</label>
          <input type="email" class="form-control" name="mail" id="mail">
        </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </div>
</form>
@endsection

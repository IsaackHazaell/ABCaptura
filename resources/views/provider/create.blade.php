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
  <div class="box-body">
  @include('provider.form')
    <div class="form-row">
      <div class="form-group col-md-6">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      <div class="form-group col-md-6">
        <a class="btn btn-primary btn-md addNew" style="float: right;" href="{{ url('provider') }}"><b>Lista de proveedores</b></a><br><br>
      </div>
    </div>
  </div>
</form>
@endsection

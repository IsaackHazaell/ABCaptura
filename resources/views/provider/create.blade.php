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
  @include('provider.form')
    <div class="form-row">
      <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </div>
</form>
@endsection

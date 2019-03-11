@extends('admin.layout')
@section('content')

<section class="content-header">
  <h1>
    Precio unitario
    <small>Agregar precio unitario</small>
  </h1>
</section>

<form action="{{url('unitPrice')}}" method="post">
  {{csrf_field()}}
  @include('unitPrice.form')

  <div class="form-group col-md-12">
    <button type="submit" class="btn btn-primary">Guardar</button>
  </div>
</form>
@endsection

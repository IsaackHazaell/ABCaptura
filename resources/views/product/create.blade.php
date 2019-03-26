@extends('admin.layout')
@section('content')

<section class="content-header">
  <h1>
    Producto
    <small>Agregar Producto</small>
  </h1>
</section>

<form action="{{url('product')}}" method="post">
  {{csrf_field()}}
  @include('product.partials.form')
    <div class="form-row">
      <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </div>
</form>
@endsection

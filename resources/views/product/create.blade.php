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
      <a class="btn btn-primary btn-md addNew" style="float: right;" href="{{ url('product') }}"><b>Lista de productos</b></a><br><br>
    </div>
  </div>
</form>
@endsection

@extends('admin.layout')
@section('content')

<section class="content-header">
  <h1>
    Precio
    <small>Agregar Precio</small>
  </h1>
</section>

<form action="{{url('price')}}" method="post">
  {{csrf_field()}}
  @include('price.partials.form')
    <div class="form-row">
      <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </div>
</form>
@endsection

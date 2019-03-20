@extends('admin.layout')
@section('content')

<section class="content-header">
  <h1>
    Unidad
    <small>Agregar Unidad</small>
  </h1>
</section>

<form action="{{url('unity')}}" method="post">
  {{csrf_field()}}
  @include('unity.form')
    <div class="form-row">
      <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </div>
</form>
@endsection

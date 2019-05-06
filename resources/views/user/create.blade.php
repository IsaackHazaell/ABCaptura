@extends('admin.layout')
@section('content')

<section class="content-header">
  <h1>
    Usuario
    <small>Agregar Usuario</small>
  </h1>
</section>

<form action="{{url('user')}}" method="post">
  {{csrf_field()}}
  @include('user.form')
    <div class="form-row">
      <div class="form-group col-md-6">
        <button type="submit" class="btn btn-success">Guardar</button>
      </div>
      <div class="form-group col-md-6">
        <a class="btn btn-primary btn-md addNew" style="float: right;" href="{{ url('user') }}"><b>Lista de usuarios</b></a><br><br>
      </div>
    </div>
</form>
@endsection

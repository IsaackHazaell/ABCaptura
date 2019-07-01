@extends('admin.layout')
@section('content')

<section class="content-header">
  <h1>
    Cliente
    <small>Agregar Cliente</small>
  </h1>
</section>

<form action="{{url('client')}}" method="post">
  {{csrf_field()}}
  @include('client.form')
  <div class="form-group col-md-12">
    <br>
  </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      <div class="form-group col-md-6">
        <a class="btn btn-primary btn-md addNew" style="float: right;" href="{{ url('client') }}"><b>Lista de clientes</b></a><br><br>
      </div>
    </div>
</form>
@endsection

@extends('admin.layout')
@section('content')
@include('user.modal')
<section class="content-header">
  <h1>
    Usuario
    <small>{{$user->id}}</small>
  </h1>
</section>

<div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">Nombre</label>
      <input type="text" class="form-control" required name="name" id="name" value="{{$user->name}}" readonly>
    </div>

    <div class="form-group col-md-6">
      <label for="email">Email</label>
      <input type="email" class="form-control" required name="email" id="email" value="{{$user->email}}" readonly>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="password">Contraseña</label>
      <input type="password" class="form-control" required name="password" id="password" value="{{$user->password}}" readonly>
    </div>
    <div class="form-group col-md-6">
      <label for="user_type">Tipo de usuario</label>
      <input type="text" class="form-control" required name="user_type" id="user_type" value="{{$user->user_type}}" readonly>
    </div>
  </div>


  <div class="form-row">
    <div class="form-group col-md-6">
      <button class="btn btn-success"
      data-iduser="{{$user->id}}"
      data-name="{{$user->name}}"
      data-email="{{$user->email}}"
      data-password="{{$user->password}}"
      data-user_type="{{$user->user_type}}"

      data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i>Editar</button>
    </div>

    <div class="form-group col-md-6">
      <a class="btn btn-primary btn-md addNew" style="float: right;" href="{{ url('user') }}"><b>Lista de Usuarios</b></a><br><br>
    </div>
  </div>
@endsection

@section('adminlte_js')
  @include('user.partials.script')
@stop

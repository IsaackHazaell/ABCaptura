@extends('admin.layout')

@section('adminlte_css')
  <meta name="csrf-token" = content="{{ csrf_token() }}">
@stop

@section('content-header')
  <h1>
    Usuarios
  </h1>
@stop

@section('content')
      <h2>Lista de Usuarios</h2>

      <a class="btn btn-success btn-md addNew" style="float: right;" href="{{ url('user/create') }}"><b>Agregar Nuevo</b></a><br><br>

      <div class="box-body">
          <table id="users_table" class="table table-striped table-bordered" style="width:100%">
          <thead>
              <tr>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Contraseña</th>
                  <th>Tipo de Usuario</th>
                  <th width="120px">Acciones</th>
              </tr>
          </thead>
      </table>
      </div>
@stop

@section('adminlte_js')
@include('user.partials.script')
@stop

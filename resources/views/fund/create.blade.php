@extends('admin.layout')
@section('content')

<section class="content-header">
  <h1>
    Crear Fondo
  </h1>
  <br>
</section>

<form action="{{url('fund')}}" method="post">
  {{csrf_field()}}
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="total">Selecciona obra</label>
      <select class="form-control" name="construction" id="construction">
              @foreach($constructions as $construction)
              <option>{{$construction->id}} {{$construction->name}}</option>
              @endforeach
      </select>
    </div>
    <div class="form-group col-md-6">
      <label for="total">Total</label>
      <input type="number" class="form-control" name="total" id="total">
    </div>
  </div>
  <br>
  <div class="form-group col-md-6">
    <button type="submit" class="btn btn-primary">Guardar</button>
  </div>
</form>
@endsection

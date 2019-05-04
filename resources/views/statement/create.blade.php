@extends('admin.layout')
@section('content')

<section class="content-header">
  <h1>
    Crear Estado de cuenta
  </h1>
  <br>
</section>

<form action="{{url('statement')}}" method="post">
  {{csrf_field()}}
  <div class="form-group col-md-6">
    <label for="construction_id">Selecciona obra</label>
    <select class="form-control" name="construction_id" id="construction_id">
            @foreach($constructions as $construction)
            <option value={{$construction->id}}>{{$construction->name}}</option>
            @endforeach
    </select>
  </div>
  <div class="form-group col-md-6">
    <label for="provider_id">Selecciona proveedor</label>
    <select class="form-control" name="provider_id" id="provider_id">
            @foreach($providers as $provider)
            <option value={{$provider->id}}>{{$provider->name}}</option>
            @endforeach
    </select>
  </div>
  <div class="form-group col-md-6">
    <label for="status">Seleccione el Estatus</label>
    <select class="form-control" name="status" id="status">
      <option value="0">Liquidado</option>
      <option value="1">Activo</option>
    </select>
  </div>
  <div class="form-group col-md-6">
    <label for="total">Total</label>
    <input type="text" class="form-control" name="total" id="total">
  </div>
  <!-- <div class="form-group col-md-6">
    <label for="remaining">Restante del fondo</label>
    <input type="number" class="form-control" name="remaining" id="remaining">
  </div> -->
  <div class="form-group col-md-6">
    <br><button type="submit" class="btn btn-success">Guardar</button>
    <a class="btn btn-primary btn-md addNew" style="float: right;" href="{{ url('statement') }}"><b>Lista de estados de cuenta</b></a>
  </div>
</form>
@endsection

<script>
  var select = document.getElementById('status');
  select.onchange = function(){
      this.form.submit();
  };
</script>
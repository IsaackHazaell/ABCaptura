@extends('admin.layout')
@section('content')

<section class="content-header">
  <h1>
    Obra
    <small>Crear Obra</small>
  </h1>
</section>

<form action="{{url('construction')}}" method="post">
  {{csrf_field()}}
  <div class="form-row">
      <div class="form-group col-md-6">
        <label for="name">Nombre</label>
        <input type="text" class="form-control" name="name" id="name">
      </div>
      <div class="form-group col-md-6">
        <label for="status">Seleccione el status</label>
        <select class="form-control" name"status" id="status">
          <option value="" class="hidden"></option>
          <option value="1">Activo</option>
          <option value="2">Finalizado</option>
          <option value="3">Espera</option>
        </select>
      </div>
    </div>
<div class="form-group col-md-6">
<button type="submit" class="btn btn-primary">Guardar</button>
</div>
</form>
@endsection

<script>
var select = document.getElementById('status');
select.onchange = function(){
    this.form.submit();
};
document.write("Hola");
</script>

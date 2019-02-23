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
  @include('construction.form')
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
</script>

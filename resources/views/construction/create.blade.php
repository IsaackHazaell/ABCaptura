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
    <br><button type="submit" class="btn btn-success">Guardar</button>
    <a class="btn btn-primary btn-md addNew" style="float: right;" href="{{ url('construction') }}"><b>Lista de obras</b></a>
  </div>
</form>
@endsection

<script>
var select = document.getElementById('status');
select.onchange = function(){
    this.form.submit();
};
</script>

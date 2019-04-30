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
  @include('statement.form')
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

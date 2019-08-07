@extends('admin.layout')
@section('content')

<section class="content-header">
  <h1>
    Honorarios
  </h1>
</section>

<form action="{{route('honorary.index')}}" >
  {{csrf_field()}}
  <br>
  @include('honorary.partials.formSelect')
    <div class="form-row">
      <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary">Continuar</button>
      </div>
    </div>
</form>
@endsection

@section('adminlte_js')
<script>
      $("#construction_id").select2();
</script>
@stop

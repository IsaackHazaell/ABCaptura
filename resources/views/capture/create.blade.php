@extends('admin.layout')
@section('content')

<section class="content-header">
  <h1>
    Captura
  </h1>
</section>

<form action="{{route('capture.create2') }}" enctype="multipart/form-data" method="post">
  {{csrf_field()}}
  @include('capture.partials.form')
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
      $("#provider_id").select2();
      $("#statemnt_material_id").select2();
  </script>
  @include('capture.partials.script_create')
@stop

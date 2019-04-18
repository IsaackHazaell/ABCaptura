@extends('admin.layout')
@section('content')

<section class="content-header">
  <h1>
    Captura
  </h1>
  <br>
  <p>Obra: {{$data->construction_id}} - Proveedor: {{$data->provider_id}}</p>
</section>

<form action="">
<meta name="csrf-token" content="{{ csrf_token() }}">

  @include('capture.partials.form_logistic')
    <div class="form-row">
      <div class="form-group col-md-6">
        @include('capture.partials.form2')
      </div>
    </div>
    </form>
    <div class="form-row">
      <div class="form-group col-md-12">
    <br><button id="saveCapture" name="saveCapture" class="btn btn-success">Guardar</button>
</div>
</div>
  @endsection

@section('adminlte_js')
    @include('capture.partials.script')
@stop

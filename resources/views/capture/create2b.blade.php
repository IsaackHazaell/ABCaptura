@extends('admin.layout')
@section('content')

<section class="content-header">
  <h1>
    Captura
  </h1>
  <br>
  <p>Obra: {{$data->construction_id}} - Proveedor: {{$data->provider_id}}</p>
</section>

<form id="formulario" name="formulario" action="">
<meta name="csrf-token" content="{{ csrf_token() }}">

  @include('capture.partials.form2b')
    <div class="form-row">
      <div class="form-group col-md-6">
        <input type="hidden" name="construction_id" id="construction_id" value={{$data->construction_id}}>
        <input type="hidden" name="provider_id" id="provider_id" value={{$data->provider_id}}>
        <input type="hidden" name="fund_id" id="fund_id" value={{$data->fund_id}}>
        <input type="hidden" name="date" id="date" value={{$data->date}}>
        <input type="hidden" name="vaucher" id="vaucher" value={{$data->file}}>
        <input type="hidden" name="folio" id="folio" value={{$data->folio}}>

      </div>
    </div>
    </form>
    <br><button id="saveCapture" name="saveCapture" class="btn btn-success">Guardar</button>
  @endsection

@section('adminlte_js')
    @include('capture.partials.script2b')
    @include('capture.partials.sweetalert')
@stop

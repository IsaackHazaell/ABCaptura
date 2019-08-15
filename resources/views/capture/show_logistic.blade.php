@extends('admin.layout')
@section('content')
    <section class="content-header">
      <h1>
        Captura
      </h1>
    </section>
  <div class="box-body">
    @include('capture.partials.form_show')
    <div class="form-group col-md-6">
        <label for="provider_id">Proveedor</label>
        <input type="text" class="form-control" readonly name="provider_id" id="provider_id" value="{{ $provider }}">
      </div>

    <div class="form-group col-md-12">
      <a class="btn btn-primary btn-md addNew" style="float: right;" href="{{ url('capture') }}"><b>Lista de Capturas</b></a><br><br>
    </div>
  </div>
</div>
@endsection

@section('adminlte_js')
    @include('capture.partials.script_show')
@stop

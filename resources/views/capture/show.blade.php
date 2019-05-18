@extends('admin.layout')
@section('content')
    <section class="content-header">
      <h1>
        Captura
        <small>{{$capture->id}}</small>
      </h1>
    </section>

<div class="form-row">
    <div class="form-group col-md-6">
      <label for="voucher">Comprobante:</label>
      <img class="img-responsive" src="{{ Storage::url("../storage/{$capture->voucher}") }}" width="300" height="300"/>
    </div>
</div>

    <div class="form-group col-md-6">
      <a class="btn btn-primary btn-md addNew" style="float: right;" href="{{ url('capture') }}"><b>Lista de Capturas</b></a><br><br>
    </div>
  </div>
@endsection

@section('adminlte_js')
@stop

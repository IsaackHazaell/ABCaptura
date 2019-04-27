@extends('admin.layout')
@section('content')
    <section class="content-header">
      <h1>
        Captura
        <small>{{$capture->id}}</small>
      </h1>
    </section>
 <img class="img-responsive" src="/storage/{{ $capture->voucher }}">
 <img src="{{ url('storage/app/'.$capture->voucher) }}" alt="" title="" />
 <img src="{{ Storage::url("/storage/{$capture->voucher}") }}" alt="" />
<div class="form-row">
    <div class="form-group col-md-6">
      <label for="voucher">Comprobante</label>

    </div>


  </div>

    <div class="form-group col-md-6">
      <a class="btn btn-primary btn-md addNew" style="float: right;" href="{{ url('capture') }}"><b>Lista de Capturas</b></a><br><br>
    </div>
  </div>
@endsection

@section('adminlte_js')
@stop

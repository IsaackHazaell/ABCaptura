@extends('admin.layout')
@section('content')
    <section class="content-header">
      <h1>
        Captura
        <small>{{$capture->id}}</small>
      </h1>
    </section>

    @include('capture.partials.form_show')

    <div class="form-group col-md-12">
      <a class="btn btn-primary btn-md addNew" style="float: right;" href="{{ url('capture') }}"><b>Lista de Capturas</b></a><br><br>
    </div>
  </div>
@endsection

@section('adminlte_js')
    @include('capture.partials.script_show')
@stop

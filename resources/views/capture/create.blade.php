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
  @//include('capture.partials.script')
@stop

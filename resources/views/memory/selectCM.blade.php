@extends('admin.layout')
@section('content')

<section class="content-header">
  <h1>
    Memoria
  </h1>
</section>

<form action="{{route('memory.index')}}" >
  {{csrf_field()}}
  <br>
  @include('memory.partials.formSelect')
    <div class="form-row">
      <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary">Continuar</button>
      </div>
    </div>
</form>
@endsection

@section('adminlte_js')

@stop

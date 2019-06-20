@extends('admin.layout')
@section('content')

<section class="content-header">
  <h1>
    Editar captura
  </h1>
</section>

<form action="{{route('capture.update','modifycapture')}}" enctype="multipart/form-data" method="post" files="true">
    {{method_field('patch')}}
    {{csrf_field()}}
  @include('capture.partials.form_edit')


      @if($capture->iva == 1)
      <div class="form-row">
          <div class="form-group col-md-6">
              <label for="subtotal_iva">Sub total sin iva</label>
              <input type="number" class="form-control" required name="subtotal_iva" id="subtotal_iva">
          </div>
          <div class="form-group col-md-6">
              <label for="total">Total</label>
              <input type="number" class="form-control" required name="total" id="total" readonly value="{{ $capture->total }}">
          </div>
      </div>
      @else
      <div class="form-group col-md-6">
          <label for="total">Total</label>
          <input type="number" class="form-control" required name="total" id="total" value="{{ $capture->total }}">
      </div>
      @endif

      <input type="hidden" name="id" id="id" value="{{ $capture->id }}">
      <input type="hidden" name="category" id="category" value="{{ $capture->provider->category }}">
      <input type="hidden" name="voucher_prev" id="voucher_prev" value="{{ $capture->voucher }}">

    <div class="form-row">
      <div class="form-group col-md-6">
        <button type="submit" class="btn btn-primary">Editar</button>
      </div>
      <div class="form-group col-md-6">
        <a class="btn btn-info btn-md addNew" style="float: right;" href="{{ url('capture') }}"><b>Lista de Capturas</b></a><br><br>
      </div>
    </div>
</form>
@endsection

@section('adminlte_js')
    @include('capture.partials.script_edit_logistic')
@stop

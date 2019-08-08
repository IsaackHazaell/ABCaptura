@extends('admin.layout')
@section('content')

<section class="content-header">
  <h1>
    Crear Fondo
  </h1>
  <br>
</section>

<form action="{{url('fund')}}" method="post">
  {{csrf_field()}}
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="total">Selecciona obra</label>
      <select class="form-control" name="construction" id="construction">
              @foreach($constructions as $construction)
              <option value="{{ $construction->id }}">{{$construction->name}}</option>
              @endforeach
      </select>
    </div>
    <div class="form-group col-md-6">
      <label for="date"class="required">Fecha</label>
      <input type="date" class="form-control" name="date" id="date" required>
    </div>

    <div class="form-group col-md-6">
      <label for="total" class="required">Total</label>
      <input type="number" step="any" class="form-control" name="total" id="total" required>
    </div>

    <div class="form-group col-md-6">
      <label for="date"class="required">Método de pago</label>
      <select class="form-control" name="pay" name="pay" id="pay">
        <option value="Efectivo" {{ isset($pay) && $pay == "Efectivo" ? 'selected' : '' }}>Efectivo</option>
        <option value="Transferencia" {{ isset($status) && $pay == "Transferencia" ? 'selected' : '' }}>Transferencia</option>
        <option value="Cheque" {{ isset($pay) && $pay == "Cheque" ? 'selected' : '' }}>Cheque</option>
      </select>
    </div>

  </div>
  <br>
  <div class="form-group col-md-6">
    <br>
    <button type="submit" class="btn btn-success">Guardar</button>
  </div>
  <div class="form-group col-md-6">
    <a class="btn btn-primary btn-md addNew" style="float: right;" href="{{ url('fund') }}"><b>Lista de fondos</b></a>
  </div>
</form>
@endsection

@section('adminlte_js')
    <script>
          $("#construction").select2();
    </script>
@stop
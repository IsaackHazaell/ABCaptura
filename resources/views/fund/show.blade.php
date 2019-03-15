@extends('admin.layout')
@section('content')

<div class="form-row">
  <div class="form-group col-md-12">
<h4>Fondo</h4>
</div>
</div>

<div class="form-row">
  <div class="form-group col-md-6">
    <label for="construction">Construcción</label>
    <input type="text" class="form-control" name="construction" id="construction" value="{{ $fund->construction }}" readonly>
  </div>
  <div class="form-group col-md-6">
    <label for="total">Total</label>
    <input type="number" class="form-control" name="total" id="total" value="{{ $fund->total }}" readonly>
  </div>
</div>
@endsection

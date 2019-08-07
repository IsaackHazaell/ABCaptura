@extends('admin.layout')
@section('content')

<section class="content-header">
  <h1>
    Obra: {{$contruction->name}}
  </h1>
</section>

<form action="{{route('memory.index')}}" >
  <br>
  <div class="form-row">
      <div class="form-group col-md-6">
        <label for="total_funds">Total de fondos</label>
        <input type="number" class="form-control" name="total_funds" id="total_funds" readonly value={{ $total_funds }}>
      </div>
      <div class="form-group col-md-6">
        <label for="total_spent">Total gastado</label>
        <input type="number" class="form-control" name="total_spent" id="total_spent" readonly value={{ $total_captures }}>
      </div>
  </div>

  <div class="form-row">
      <div class="form-group col-md-6">
        <label for="current_balance">Saldo actual</label>
        <input type="number" class="form-control" name="current_balance" id="current_balance" readonly value={{ $total_funds - $total_captures }}>
      </div>
  </div>

  <div class="form-row">
      <div class="form-group col-md-8">
        <br>
    </div>
  </div>

    <div class="form-row">
        <div class="form-group col-md-6">
          <label for="month">Ingrese el año y mes de la memoria</label>
          <input type="month" class="form-control" name="month" placeholder="AAAA-MM" required>
        </div>
      <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary">Ver memoria</button>
      </div>
    </div>

    <input type="hidden" name="construction_id" id="construction_id" value="{{$construction_id}}">
</form>
@endsection

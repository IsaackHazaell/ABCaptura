@extends('admin.layout')
@section('content')
@include('fund.modal')
<section class="content-header">
  <h1>
    Fondo
    <small>{{$fund->id}}</small>
  </h1>
</section>

<div class="form-row">
    <div class="form-group col-md-6">
      <label for="construction_id">Nombre</label>
      <input type="text" class="form-control" value="{{$fund->construction_id}}" readonly name="construction_id" id="construction_id">
    </div>
    <div class="form-group col-md-6">
      <label for="date">Fecha</label>
      <input type="text" class="form-control" value="{{\Carbon\Carbon::parse($fund->date)->format('d-F-Y')}}" readonly name="date" id="date">
    </div>
    <div class="form-group col-md-6">
      <label for="remaining">Restante de fondo</label>
      <input type="text" class="form-control" value="{{number_format($fund->remaining,2)}}" readonly name="remaining" id="remaining">
    </div>
    <div class="form-group col-md-6">
      <label for="total">Total</label>
      <input type="text" class="form-control" value="{{number_format($fund->total,2)}}" readonly name="total" id="total">
    </div>
    <div class="form-group col-md-6">
      <label for="pay">Metodo de pago</label>
      <input type="text" class="form-control" value="{{ $fund->pay }}" readonly name="pay" id="pay">
    </div>
</div>


  <div class="form-row">
    <div class="form-group col-md-12">
      <button class="btn btn-primary"
        data-idfund="{{$fund->id}}"
        data-construcion_id="{{$fund->construcion_id}}"
        data-date="{{$fund->date}}"
        data-remaining="{{$fund->remaining}}"
        data-total="{{$fund->total}}"
        data-pay="{{$fund->pay}}"
        data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i>Editar</button>
        <a class="btn btn-primary btn-md addNew" style="float: right;" href="{{ url('fund') }}"><b>Lista de fondos</b></a>
    </div>
  </div>

  <div class="box-body">
      <h3>Capturas relacionadas al fondo:</h3>
      <table id="capture_table" class="table table-striped table-bordered" style="width:100%">
      <thead>
          <tr>
              <th>Obra</th>
              <th>Proveedor</th>
              <th>Fecha de captura</th>
              <th>Concepto de captura</th>
              <th>Total</th>
              <th>Comprobante</th>
              <th>Acciones</th>
          </tr>
      </thead>
  </table>
  </div>
@endsection

@section('adminlte_js')
    @include('fund.partials.script_index')
<script>
$('#edit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('idfund')
    var construction_id = button.data('construction_id')
    var date = button.data('date')
  var remaining = button.data('remaining')
    var total = button.data('total')

    var data_id = button.data('iddata')
    var modal = $(this)
    modal.find('.modal-body #idfund').val(id);
    modal.find('.modal-body #construction_id').val(construction_id);
    modal.find('.modal-body #date').val(date);
  modal.find('.modal-body #remaining').val(remaining);
    modal.find('.modal-body #total').val(total);

    modal.find('.modal-body #data_id').val(data_id);
});
</script>
@include('fund.partials.script')
@endsection

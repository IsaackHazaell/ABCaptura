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
      <label for="total">Total</label>
      <input type="text" class="form-control" value="{{$fund->total}}" readonly name="total" id="total">
    </div>
</div>


  <div class="form-row">
    <div class="form-group col-md-12">
      <button class="btn btn-primary"
        data-idfund="{{$fund->id}}"
        data-construcion_id="{{$fund->construcion_id}}"
        data-total="{{$fund->total}}"
        data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i>Editar</button>
        <a class="btn btn-primary btn-md addNew" style="float: right;" href="{{ url('fund') }}"><b>Lista de fondos</b></a>
    </div>
  </div>
@endsection

@section('adminlte_js')
<script>
$('#edit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('idfund')
    var construction_id = button.data('construction_id')
    var total = button.data('total')

    //var data_id = button.data('iddata')
    var modal = $(this)
    modal.find('.modal-body #idfund').val(id);
    modal.find('.modal-body #construction_id').val(construction_id);
    modal.find('.modal-body #total').val(total);

    //modal.find('.modal-body #data_id').val(data_id);
});
</script>
@endsection

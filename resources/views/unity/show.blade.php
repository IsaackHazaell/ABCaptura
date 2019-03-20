@extends('admin.layout')
@section('content')
@include('unity.modal')
<section class="content-header">
  <h1>
    Unidad
    <small>{{$unity->id}}</small>
  </h1>
</section>

<div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">Nombre</label>
      <input type="text" class="form-control" value="{{$unity->name}}" readonly name="name" id="name">
    </div>
    <div class="form-group col-md-6">
      <label for="name">Referencia</label>
      <input type="text" class="form-control" value="{{$unity->reference}}" readonly name="reference" id="reference">
    </div>

  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="equivalent">Equivalente</label>
      <input type="text" name="equivalent" class="form-control"  readonly value="{{$unity->equivalent}}" id="equivalent">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-12">
      <button class="btn btn-primary"
        data-idunity="{{$unity->id}}"
        data-nameunity="{{$unity->name}}"
        data-referenceunity="{{$unity->reference}}"
        data-equivalentunity="{{$unity->equivalent}}"
        data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i>Editar</button>
    </div>
  </div>
@endsection

@section('adminlte_js')
<script>
$('#edit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('idunity')
    var name = button.data('nameunity')
    var reference = button.data('referenceunity')
    var equivalent = button.data('equivalentunity')

    //var data_id = button.data('iddata')
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #name').val(name);
    modal.find('.modal-body #reference').val(reference);
    modal.find('.modal-body #equivalent').val(equivalent);

    //modal.find('.modal-body #data_id').val(data_id);
});
</script>
@endsection

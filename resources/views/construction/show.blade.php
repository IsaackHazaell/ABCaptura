@extends('admin.layout')
@section('content')
@include('construction.modal')
<section class="content-header">
  <h1>
    Obras
    <small>{{$construction->id}}</small>
  </h1>
</section>

<div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">Nombre</label>
      <input type="text" class="form-control" value="{{$construction->name}}" readonly name="name" id="name">
    </div>
    <div class="form-group col-md-6">
      <label for="status">Giro</label>
      <input type="text" class="form-control" value="{{$construction->status}}" readonly name="status" id="status">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-12">
      <button class="btn btn-primary"
        data-idconstruction="{{$construction->id}}"
        data-nameconstruction="{{$construction->name}}"
        data-statusconstruction="{{$construction->status}}"
        data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i>Editar</button>
    </div>
  </div>
@endsection

@section('adminlte_js')
<script>
$('#edit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('idconstruction')
    var name = button.data('nameconstruction')
    var status = button.data('statusconstruction')

    //var data_id = button.data('iddata')
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #name').val(name);
    modal.find('.modal-body #status').val(status);
    //modal.find('.modal-body #data_id').val(data_id);
});

</script>
@endsection

@extends('admin.layout')
@section('content')
@include('provider.modal')
<section class="content-header">
  <h1>
    Proveedor
    <small>{{$provider->id}}</small>
  </h1>
</section>

<div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">Nombre</label>
      <input type="text" class="form-control" value="{{$provider->name}}" readonly name="name" id="name">
    </div>
    <div class="form-group col-md-6">
      <label for="turn">Giro</label>
      <input list="turns" class="form-control" value="{{$provider->turn}}" readonly name="turn" id="turn">
          <datalist id="turns">
            <option value="Gestoría">
            <option value="Pintor">
            <option value="Acomodar los cuadros">
            <option value="Mano de obra">
            <option value="sabe">
          </datalist>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="email">Correo</label>
      <input type="email" name="email" class="form-control" aria-describedby="emailHelp" readonly value="{{$provider->mail}}" id="email">
    </div>
    <div class="form-group col-md-6">
      <label for="phone">Teléfono</label>
      <input type="number" class="form-control" name="phone" value="{{$provider->phone}}" readonly id="phone1">
    </div>
  </div>

  @include('address.show')

  <div class="form-row">
    <div class="form-group col-md-12">
      <button class="btn btn-primary"
        data-idprovider="{{$provider->id}}"
        data-nameprovider="{{$provider->name}}"
        data-turnprovider="{{$provider->turn}}"
        data-phoneprovider="{{$provider->phone}}"
        data-mailprovider="{{$provider->mail}}"

        data-streetprovider="{{$address->street}}"
        data-colonyprovider="{{$address->colony}}"
        data-townprovider="{{$address->town}}"
        data-stateprovider="{{$address->state}}"
        data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i>Editar</button>
    </div>
  </div>
@endsection

@section('adminlte_js')
<script>
$('#edit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('idprovider')
    var name = button.data('nameprovider')
    var turn = button.data('turnprovider')
    var phone = button.data('phoneprovider')
    var mail = button.data('mailprovider')

    var street = button.data('streetprovider')
    var colony = button.data('colonyprovider')
    var town = button.data('townprovider')
    var state = button.data('stateprovider')
    //var data_id = button.data('iddata')
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #name').val(name);
    modal.find('.modal-body #turn').val(turn);
    modal.find('.modal-body #phone').val(phone);
    modal.find('.modal-body #mail').val(mail);

    modal.find('.modal-body #street').val(street);
    modal.find('.modal-body #colony').val(colony);
    modal.find('.modal-body #town').val(town);
    modal.find('.modal-body #state').val(state);
    //modal.find('.modal-body #data_id').val(data_id);
});
</script>
@endsection

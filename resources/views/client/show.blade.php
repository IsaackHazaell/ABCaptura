<div class="form-row">
  <div class="form-group col-md-12">
<h4>Cliente</h4>
</div>
</div>

<div class="form-row">
  <div class="form-group col-md-6">
    <label for="client_name">Nombre</label>
    <input type="text" class="form-control" name="client_name" id="client_name" value="{{ $client->client_name }}" readonly>
  </div>
  <div class="form-group col-md-6">
    <label for="cellphone">Celular</label>
    <input type="text" class="form-control" name="cellphone" id="cellphone" value="{{ $client->cellphone }}" readonly>
  </div>
</div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="phonelandline">Teléfono fijo</label>
      <input type="text" class="form-control" name="phonelandline" id="phonelandline" value="{{ $client->phonelandline }}" readonly>
    </div>
    <div class="form-group col-md-6">
      <label for="address">Domicilio</label>
      <input type="text" class="form-control" name="address" id="address" value="{{ $client->address }}" readonly>
    </div>
  </div>

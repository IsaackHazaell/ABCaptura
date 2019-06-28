<div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">Nombre</label>
      <input type="text" class="form-control" name="name" id="name" required>
    </div>
    <div class="form-group col-md-6">
      <label for="honorary">Porcentaje de honorarios</label>
      <input type="number" class="form-control" name="honorary" id="honorary" required>
    </div>
    <div class="form-group col-md-6">
      <label for="date">Fecha de arranque</label>
      <input type="date" class="form-control" name="date" id="date" required>
    </div>
    <div class="form-group col-md-6">
      <label for="square_meter">Metros cuadrados</label>
      <input type="number" class="form-control" name="square_meter" id="square_meter" required>
    </div>
    <div class="form-group col-md-6">
      <label for="status">Seleccione el Estatus</label>
      <select class="form-control" name="status" id="status">
        <option>Activo</option>
        <option>Espera</option>
        <option>Finalizado</option>
      </select>
    </div>

</div>
<div class="form-group col-md-12">
  <h3>Cliente</h3>
</div>
<div class="form-row">
  <div class="form-group col-md-6">
    <label for="client_id">Seleccione cliente</label>
      <select class="form-control" name="client_id" id="client_id">
        @foreach ($clients as $clie)
          <option value="{{$clie->id}}" {{ isset($client) && $client->id == $clie->id ? 'selected' : '' }}>{{$clie->name}}</option>
        @endforeach
      </select>
  </div>

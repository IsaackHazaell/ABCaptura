<div class="form-row">
  <div class="form-group col-md-6">
    <label for="provider">Seleccione el proveedor</label>
    <select class="form-control" name="provider" id="provider">
        @foreach($providers as $provider)
        <option>{{$provider->id}} {{$provider->name}}</option>
        @endforeach
    </select>
  </div>

    <div class="form-group col-md-6">
      <label for="name">Nombre</label>
      <input type="text" class="form-control" name="name" id="name">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="year">Año</label>
      <input type="number" class="form-control" min="1900" max="2099" step="1" value="2019" name="year" id="year">
    </div>

      <div class="form-group col-md-6">
        <label for="cost">Costo</label>
        <input type="number" step="0.01" placeholder="0.00" class="form-control" name="cost" id="cost">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="unit">Unidad</label>
        <input type="text" class="form-control" name="unit" id="unit">
      </div>
    </div>

<div class="form-row">
    <div class="form-group col-md-6">
      <label for="construction">Selecciona obra</label>
      <select class="form-control" name="construction" id="construction">
              <!-- @foreach($constructions as $construction)
              <option>{{$construction->id}} {{$construction->name}}</option>
              @endforeach -->
      </select>
    </div>
    <div class="form-group col-md-6">
      <label for="construction">Selecciona proveedor</label>
      <select class="form-control" name="construction" id="construction">
              @foreach($providers as $provider)
              <option>{{$provider->id}} {{$provider->name}}</option>
              @endforeach
      </select>
    </div>
    <div class="form-group col-md-6">
      <label for="status">Seleccione el Estatus</label>
      <select class="form-control" name="status" id="status">
        <option>Liquidado</option>
        <option>Activo</option>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label for="total">Total</label>
      <input type="text" class="form-control" name="total" id="total">
    </div>
    <div class="form-group col-md-6">
      <label for="remaining">Restante</label>
      <input type="number" class="form-control" name="remaining" id="remaining">
    </div>
</div>

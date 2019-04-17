<div class="form-row">
    <div class="form-group col-md-6">
      <label for="construction_id">Seleccione la obra</label>
      <select class="form-control" required name="construction_id" id="construction_id">
        @foreach($constructions as $construction)
        <option>{{$construction->id}} {{$construction->name}}</option>
        @endforeach
    </select>
    </div>

    <div class="form-group col-md-6">
      <label for="provider_id">Seleccione el proveedor</label>
      <select class="form-control" required name="provider_id" id="provider_id">
        @foreach($providers as $provider)
        <option>{{$provider->id}} {{$provider->name}}: {{$provider->category}}</option>
        @endforeach
    </select>
    </div>
  </div>

  <div class="form-row">
      <div class="form-group col-md-6">
        <label for="date">Seleccione La fecha</label>
        <input type="date" class="form-control" required name="date" id="date">
      </div>
      <div class="form-group col-md-6">
        <label for="file">Nuevo Archivo</label>
          <input type="file" class="form-control" name="file" id="file">
      </div>
  </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="folio">Folio</label>
          <input type="number" class="form-control" name="folio" id="folio">
      </div>
      <div class="form-group col-md-3">
        <label for="honorary">Honorario</label>
        <br>
        <input type="radio" name="honorary" id="honorary" value="1"> Si<br>
        <input type="radio" name="honorary" id="honorary" value="0"> No<br>
      </div>
      <div class="form-group col-md-3">
        <label for="iva">Iva</label>
        <br>
        <input type="radio" name="iva" id="iva" value="1"> Si<br>
        <input type="radio" name="iva" id="iva" value="0"> No<br>
      </div>
    </div>

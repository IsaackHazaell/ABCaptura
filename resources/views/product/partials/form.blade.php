<div class="form-row">
    <div class="form-group col-md-6">
      <label for="provider_id"class="required">Proveedor</label>
      <select class="form-control" required name="provider_id" id="provider_id">
        @foreach($providers as $provider)
        <option>{{$provider->id}} {{$provider->name}}</option>
        @endforeach
    </select>
    </div>

    <div class="form-group col-md-6">
      <label for="concept"class="required">Concepto</label>
      <input type="text" class="form-control" placeholder="cemento" required name="concept" id="concept">
    </select>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="description">Descripción adicional</label>
      <input type="text" class="form-control" name="description" id="description">
    </div>
  </div>
@include('price.partials.form')

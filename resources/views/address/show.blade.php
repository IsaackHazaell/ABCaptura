<div class="form-row">
  <div class="form-group col-md-12">
<h4>Domicilio</h4>
</div>
</div>

<div class="form-row">
  <div class="form-group col-md-6">
    <label for="street">Calle y número</label>
    <input type="text" class="form-control" name="street" id="street" value="{{ $address->street }}" readonly>
  </div>
  <div class="form-group col-md-6">
    <label for="colony">Colonía</label>
    <input type="text" class="form-control" name="colony" id="colony" value="{{ $address->colony }}" readonly>
  </div>
</div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="town">Municipio</label>
      <input type="text" class="form-control" name="town" id="town" value="{{ $address->town }}" readonly>
    </div>
    <div class="form-group col-md-6">
      <label for="state">Estado</label>
      <input type="text" class="form-control" name="state" id="state" value="{{ $address->state }}" readonly>
    </div>
  </div>

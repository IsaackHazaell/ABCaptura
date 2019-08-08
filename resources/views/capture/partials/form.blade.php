<div class="form-row">
    <div class="form-group col-md-6">
      <label for="construction_id"class="required">Obra</label>
      <select class="form-control" onchange="changeProviders()" required name="construction_id" id="construction_id">
        @foreach($constructions as $construction)
        <option value="{{$construction->id}}">{{$construction->name}}</option>
        @endforeach
    </select>
    </div>

    <div class="form-group col-md-6">
        <label for="status" class="required">Seleccione la categoría del proveedor</label>
        <select class="form-control" required name="category" id="category" onchange="clearInputs()">
            <option value="0">Mano de obra o logística</option>
             <option value="1">Material</option>
        </select>
      </div>

    <div class="form-group col-md-6" id="div_logistic">
      <label for="provider_id"class="required">Proveedor</label>
      <select class="form-control" required name="provider_id" id="provider_id"></select>
    </div>
  </div>

  <div id="div_material">
      <div class="form-group col-md-6">
        <label for="statemnt_material_id">Estado de cuenta</label>
        <select class="form-control" required name="statemnt_material_id" id="statemnt_material_id"></select>
      </div>
    </div>

  <div class="form-row">
      <div class="form-group col-md-6">
        <label for="date"class="required">Fecha</label>
        <input type="date" class="form-control" required name="date" id="date">
      </div>
      <div class="form-group col-md-6">
        <label for="voucher">Comprobante</label>
          <input type="file" class="form-control" name="voucher" id="voucher">
      </div>
  </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="folio">Folio</label>
          <input type="text" class="form-control" name="folio" id="folio">
      </div>
      <div class="form-group col-md-6">
        <label for="concept"class="required">Concepto</label>
        <input type="text" class="form-control" required name="concept" id="concept">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-3">
        <label for="honorarium">Honorario</label>
        <br>
        <input type="radio" name="honorarium" id="honorarium" value="1" required> Si<br>
        <input type="radio" name="honorarium" id="honorarium" value="0"> No<br>
      </div>
      <div class="form-group col-md-3">
        <label for="iva">Iva</label>
        <br>
        <input type="radio" name="iva" id="iva" value="1" required> Si<br>
        <input type="radio" name="iva" id="iva" value="0"> No<br>
      </div>
    </div>

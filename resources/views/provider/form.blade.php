<div class="form-row">
    <div class="form-group col-md-6">
      <label for="name" class="required">Nombre</label>
      <input type="text" class="form-control" required name="name" id="name">
    </div>

    <div class="form-group col-md-6">
      <label for="category" class="required">Categoría</label>
      <select class="form-control" required name="category" id="category" onchange="check_rfc()">
        <option value="0">Mano de obra</option>
         <option value="1">Material</option>
         <option value="2">Logística</option>
    </select>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="turn"class="required">Giro</label>
      <input list="turns" class="form-control" required name="turn" id="turn">
          <datalist id="turns">
            <option value="Gestoría">
            <option value="Pintor">
            <option value="Acomodar los cuadros">
          </datalist>
    </div>
    <div class="form-group col-md-6">
      <label for="company">Empresa</label>
      <input type="text" class="form-control" name="company" id="company">
    </div>

  </div>

<div class="form-row">
  <div class="form-group col-md-6">
    <label for="cellphone"class="required">Teléfono celular</label>
    <input type="number" class="form-control" required name="cellphone" id="cellphone">
  </div>
  <div class="form-group col-md-6">
    <label for="phonlandline">Teléfono fijo</label>
    <input type="number" class="form-control" name="phonlandline" id="phonlandline">
  </div>
</div>

<div class="form-row">
      <div class="form-group col-md-6">
        <label for="mail">Correo</label>
        <input type="email" class="form-control" name="mail" id="mail">
      </div>
</div>

<div class="form-row" id="rfc_div">
  <div class="form-group col-md-6">
    <label for="rfc">RFC</label>
    <input type="text" class="form-control" name="rfc" id="rfc">
  </div>
</div>

<div>
    @include('address.create')
</div>

<div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">Nombre</label>
      <input type="text" class="form-control" required name="name" id="name">
    </div>

    <div class="form-group col-md-6">
      <label for="category">Categoría</label>
      <select class="form-control" required name="category" id="category">
        <option value="0">Mano de obra</option>
         <option value="1">Material</option>
         <option value="2">Logística</option>
    </select>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="turn">Giro</label>
      <input list="turns" class="form-control" required name="turn" id="turn">
          <datalist id="turns">
            <option value="Gestoría">
            <option value="Pintor">
            <option value="Acomodar los cuadros">
          </datalist>
    </div>
        <div class="form-group col-md-6">
          <label for="phone">Teléfono</label>
          <input type="number" class="form-control" required name="phone" id="phone">
        </div>
      </div>

<div class="form-row">
      <div class="form-group col-md-6">
        <label for="mail">Correo</label>
        <input type="email" class="form-control" name="mail" id="mail">
      </div>
</div>

  @include('address.create')

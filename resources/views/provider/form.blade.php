<div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">Nombre</label>
      <input type="text" class="form-control" name="name" id="name">
    </div>
    <div class="form-group col-md-6">
      <label for="turn">Giro</label>
      <input list="turns" class="form-control" name="turn" id="turn">
          <datalist id="turns">
            <option value="Gestoría">
            <option value="Pintor">
            <option value="Acomodar los cuadros">
            <option value="Mano de obra">
            <option value="sabe">
          </datalist>
    </div>
  </div>

  <div class="form-row">
        <div class="form-group col-md-6">
          <label for="phone">Teléfono</label>
          <input type="number" class="form-control" name="phone" id="phone">
        </div>
        <div class="form-group col-md-6">
          <label for="mail">Correo</label>
          <input type="email" class="form-control" name="mail" id="mail">
        </div>
      </div>


  @include('address.create')

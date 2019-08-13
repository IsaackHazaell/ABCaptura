<div class="form-row">
    <div class="form-group col-md-6">
      <label for="unity"class="required">Unidad</label>
      <input type="text" step="any" class="form-control" required name="unity" id="unity">
    </div>
  </div>

  <div class="form-row">
      <div class="form-group col-md-6">
        <label for="price"class="required">Precio unitario sin IVA</label>
        <input type="number" step="any" class="form-control" required name="price" id="price">
      </div>
      <div class="form-group col-md-6">
        <label for="month" class="required">Mes</label>
        <select class="form-control" required name="month" id="month">
          <option value="">Seleccione el mes</option>
          <option  value="Enero" {{ isset($month) && $month == "Enero" ? 'selected' : '' }}>Enero</option>
          <option value="Febrero {{ isset($month) && $month == "Febrero" ? 'selected' : '' }}">Febrero</option>
           <option value="Marzo {{ isset($month) && $month == "Marzo" ? 'selected' : '' }}">Marzo</option>
           <option value="Abril {{ isset($month) && $month == "Abril" ? 'selected' : '' }}">Abril</option>
           <option value="Mayo {{ isset($month) && $month == "Mayo" ? 'selected' : '' }}">Mayo</option>
           <option value="Junio {{ isset($month) && $month == "Junio" ? 'selected' : '' }}">Junio</option>
           <option value="Julio {{ isset($month) && $month == "Julio" ? 'selected' : '' }}">Julio</option>
           <option value="Agosto {{ isset($month) && $month == "Agosto" ? 'selected' : '' }}">Agosto</option>
           <option value="Septiembre {{ isset($month) && $month == "Septiembre" ? 'selected' : '' }}">Septiembre</option>
           <option value="Octubre {{ isset($month) && $month == "Octubre" ? 'selected' : '' }}">Octubre</option>
           <option value="Noviembre {{ isset($month) && $month == "Noviembre" ? 'selected' : '' }}">Noviembre</option>
           <option value="Diciembre {{ isset($month) && $month == "Diciembre" ? 'selected' : '' }}">Diciembre</option>
      </select>
      </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
          <label for="year" class="required">Año</label>
          <input type="number" class="form-control" min="1900" max="2099" step="1" required value="{{now()->year}}" name="year" id="year"/>
        </div>
      </div>

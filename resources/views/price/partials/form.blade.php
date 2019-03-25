<div class="form-row">
    <div class="form-group col-md-6">
      <label for="product_id">Producto</label>
      <select class="form-control" required name="product_id" id="product_id">
        @foreach($products as $product)
        <option>{{$product->id}} {{$product->concept}}</option>
        @endforeach
    </select>
    </div>
    <div class="form-group col-md-6">
      <label for="unity_id">Unidad</label>
      <select class="form-control" required name="unity_id" id="unity_id">
        @foreach($unities as $unity)
        <option>{{$unity->id}} {{$unity->name}}</option>
        @endforeach
    </select>
    </div>
  </div>

  <div class="form-row">
      <div class="form-group col-md-6">
        <label for="price">Precio unitario</label>
        <input type="number" step="any" class="form-control" required name="price" id="price">
      </div>
      <div class="form-group col-md-6">
        <label for="month">Mes</label>
        <select class="form-control" required name="month" id="month">
          <option value="1">Enero</option>
           <option value="2">Febrero</option>
           <option value="3">Marzo</option>
           <option value="4">Abril</option>
           <option value="5">Mayo</option>
           <option value="6">Junio</option>
           <option value="7">Julio</option>
           <option value="8">Agosto</option>
           <option value="9">Septiembre</option>
           <option value="10">Octubre</option>
           <option value="11">Noviembre</option>
           <option value="12">Diciembre</option>
      </select>
      </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
          <label for="year">Año</label>
          <input type="number" class="form-control" min="1900" max="2099" step="1" value="2019" name="year" id="year"/>
        </div>
      </div>

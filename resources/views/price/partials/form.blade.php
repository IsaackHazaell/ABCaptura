<div class="form-row">
    <div class="form-group col-md-6">
      <label for="construction_id">Obra</label>
      <select class="form-control" required name="construction_id" id="construction_id">
        @foreach($constructions as $construction)
        <option>{{$construction->id}} {{$construction->name}}</option>
        @endforeach
    </select>
    </div>

    <div class="form-group col-md-6">
      <label for="product_id">Producto</label>
      <select class="form-control" required name="product_id" id="product_id">
        @foreach($products as $product)
        <option>{{$product->id}} {{$product->concept}}</option>
        @endforeach
    </select>
    </div>
  </div>

  <div class="form-row">
      <div class="form-group col-md-6">
        <label for="unity_id">Unidad</label>
        <select class="form-control" required name="product_id" id="product_id">
          @foreach($unities as $unity)
          <option>{{$unity->id}} {{$unity->name}}</option>
          @endforeach
      </select>
      </div>

      <div class="form-group col-md-6">
        <label for="price">Precio</label>
        <input type="number" step="any" class="form-control" required name="price" id="price">
      </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
          <label for="year">Año</label>
          <input type="number" class="form-control" min="1900" max="2099" step="1" value="2019" name="year" id="year"/>
        </div>
      </div>

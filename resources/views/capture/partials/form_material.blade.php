  <div class="form-row">
      <div class="form-group col-md-6">
        <label for="product">Producto</label>
        <select class="form-control" required name="product" id="product">
         
            @foreach($statement_material->providers as $provider)
              @foreach($provider->products as $product)
                <option value={{$product->price->price}}/{{$product->price->id}}> {{$product->price->unity}} {{$product->concept}} - {{$product->price->month}} </option>
              @endforeach
            @endforeach
          
      </select>
      </div>

      <div class="form-group col-md-6">
        <label for="price">Precio</label>
        <input type="number" readonly class="form-control" required name="priceCapture" id="priceCapture">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="quantity">Cantidad</label>
        <input type="number" class="form-control" required value=1 name="quantity" id="quantity">
      </div>
      <div class="form-group col-md-6">
        <label for="extra">Cargo adicional</label>
        <input type="number" class="form-control" required value=0 name="extra" id="extra">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="total_product">Total</label>
        <input type="number" readonly class="form-control" required name="total_product" id="total_product">
      </div>

      <input type="hidden" name="product_id" id="product_id">
      <input type="hidden" name="capture_id" id="capture_id" value="{{$data->id}}">
    </div>

  <div class="form-row">
      <div class="form-group col-md-6">
        <label for="product">Seleccione el producto</label>
        <select class="form-control" required name="product" id="product">
          @foreach($prices as $price)
          <option value={{$price->price}}/{{$price->product_id}}> {{$price->unity}} {{$price->product_concept}} - {{$price->month}} </option>
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
        <label for="quantity">Seleccione La cantidad</label>
        <input type="number" class="form-control" required value=1 name="quantity" id="quantity">
      </div>
      <div class="form-group col-md-6">
        <label for="extra">Cargo adicional</label>
        <input type="number" class="form-control" required value=0 name="extra" id="extra">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="total">Total</label>
        <input type="number" readonly class="form-control" required name="total" id="total">
      </div>
      <div class="form-group col-md-3">
        <label for="honorary">Honorario</label>
        <br>
        <input type="radio" name="honorary" id="honorary" value="0"> Si<br>
        <input type="radio" name="honorary" id="honorary" value="1"> No<br>
      </div>
      <div class="form-group col-md-3">
        <label for="iva">Iva</label>
        <br>
        <input type="radio" name="iva" id="iva" value="0"> Si<br>
        <input type="radio" name="iva" id="iva" value="1"> No<br>
      </div>

      <input type="hidden" name="product_id" id="product_id">
    </div>

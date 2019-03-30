<div class="form-row">
    <div class="form-group col-md-6">
      <label for="fund_id">Seleccione el fondo</label>
      <select class="form-control" required name="fund_id" id="fund_id">
        @foreach($funds as $fund)
        <option>{{$fund->id}} {{$fund->name}}</option>
        @endforeach
    </select>
    </div>

    <div class="form-group col-md-6">
      <label for="date">Seleccione La fecha</label>
      <input type="date" class="form-control" required name="date" id="date">
    </div>
  </div>

  <div class="form-row">
      <div class="form-group col-md-6">
        <label for="product">Seleccione el producto</label>
        <select class="form-control" required name="product" id="product">
          @foreach($prices as $price)
          <option value={{$price->price}}/{{$price->product_id}}> {{$price->unity}} {{$price->product_concept}} </option>
          @endforeach
      </select>
      </div>

      <div class="form-group col-md-6">
        <label for="price">Precio</label>
        <input type="number" readonly class="form-control" required name="price" id="price">
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

      <input type="hidden" name="product_id" id="product_id">
    </div>

<div class="form-row">
  <div class="form-group col-md-6">
    <label for="fund_id">Seleccione el fondo</label>
    <select class="form-control" required name="fund_id" id="fund_id">
      @foreach($funds as $fund)
      <option value={{$fund->id}}/{{$fund->remaining}}>{{$fund->id}} {{$fund->name}} - {{$fund->date}}</option>
      @endforeach
  </select>
  </div>
    <div class="form-group col-md-6">
      <label for="concept">Concepto</label>
      <input type="text" class="form-control" required name="concept" id="concept">
    </div>

    <div class="form-group col-md-6">
      <label for="total">Total</label>
      <input type="number" class="form-control" required name="total" id="total">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="honorary">Honorario</label>
      <br>
      <input type="radio" name="honorary" id="honorary" value="1"> Si<br>
      <input type="radio" name="honorary" id="honorary" value="0"> No<br>
    </div>
    <div class="form-group col-md-3">
      <label for="iva">Iva</label>
      <br>
      <input type="radio" name="iva" id="iva" value="1"> Si<br>
      <input type="radio" name="iva" id="iva" value="0"> No<br>
    </div>
  </div>

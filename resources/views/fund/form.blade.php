<div class="form-row">
    <div class="form-group col-md-6">
      <label for="date"class="required">Fecha</label>
      <input type="date" class="form-control" name="date" id="date"required>
    </div>
    <div class="form-group col-md-6">
      <label for="total"class="required">Total</label>
      <input type="text" class="form-control" name="total" id="total" step="any" required>
    </div>
</div>

<div class="form-row">
  <div class="form-group col-md-6">
    <label for="date"class="required">Método de pago</label>
    <select class="form-control" name="pay" name="pay" id="pay" required>
      <option value="Efectivo" {{ isset($pay) && $pay == "Efectivo" ? 'selected' : '' }}>Efectivo</option>
      <option value="Transferencia" {{ isset($status) && $pay == "Transferencia" ? 'selected' : '' }}>Transferencia</option>
      <option value="Cheque" {{ isset($pay) && $pay == "Cheque" ? 'selected' : '' }}>Cheque</option>
    </select>
  </div>
</div>

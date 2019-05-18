@if($data->iva == 1)
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="subtotal_iva">Sub total sin iva</label>
        <input type="number" class="form-control" required name="subtotal_iva" id="subtotal_iva">
    </div>
    <div class="form-group col-md-6">
        <label for="total">Total</label>
        <input type="number" class="form-control" required name="total" id="total" readonly>
    </div>
</div>
@else
<div class="form-group col-md-6">
    <label for="total">Total</label>
    <input type="number" class="form-control" required name="total" id="total">
</div>
@endif

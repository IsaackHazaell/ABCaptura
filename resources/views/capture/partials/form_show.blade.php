<div class="form-row">
    <div class="form-group col-md-6">
      <label for="construction_id">Obra</label>
      <input type="text" class="form-control" readonly name="construction_id" id="construction_id" value="{{ $construction }}">
    </div>

    <div class="form-group col-md-6">
      <label for="provider_id">Proveedor</label>
      <input type="text" class="form-control" readonly name="provider_id" id="provider_id" value="{{ $provider }}">
    </div>
  </div>

  <div class="form-row">
      <div class="form-group col-md-6">
        <label for="date">Fecha</label>
        <input type="date" class="form-control" name="date" id="date" value="{{ $capture->date }}" readonly>
      </div>
  </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="folio">Folio</label>
          <input type="text" class="form-control" name="folio" id="folio" value="{{ $capture->folio }}" readonly>
      </div>
      <div class="form-group col-md-6">
        <label for="concept">Concepto</label>
        <input type="text" class="form-control" name="concept" id="concept" value="{{ $capture->concept }}" readonly>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-3">
        <label for="honorarium">Honorario</label>
        <input type="text" class="form-control" name="honorarium" id="honorarium" value="{{ $capture->honorarium }}" readonly>
      </div>
      <div class="form-group col-md-3">
        <label for="iva">Iva</label>
        <input type="text" class="form-control" name="iva" id="iva" value="{{ $capture->iva }}" readonly>
      </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            @if($capture->voucher != null)
                <div class="form-group col-md-6">
                  <label for="voucher">Comprobante:</label>
                  <img class="img-responsive" src="{{ Storage::url("../storage/{$capture->voucher}") }}" width="300" height="300"/>
                </div>
            @endif
        </div>
    </div>

    @if($isProduct)
        <div class="form-row">
            <div class="box-body">
                <div class="form-group col-md-12">
                    <h3>Productos:</h3>
                    <table id="products_capture_show_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Unidad</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Costo adicional</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    @endif
<div class="form-row">
    <div class="form-group col-md-6">
      <label for="construction_id">Obra</label>
      <input type="text" class="form-control" readonly name="construction_id" id="construction_id" value="{{ $construction }}">
    </div>
    <div class="form-group col-md-6">
        <label for="date">Fecha</label>
        <input type="text" class="form-control" name="date" id="date" value="{{  \Carbon\Carbon::parse($capture->date)->format('d-F-Y') }}" readonly>
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
          <label for="total">Total</label>
          <input type="text" class="form-control" name="total" id="total" value="{{ number_format($capture->total,2) }}" readonly>
        </div>
        
            @if($capture->voucher != null)
                <div class="form-group col-md-6">
                <label for="voucher">Comprobante:</label>
                <br>
                  <a href="{{ route('capture.download', ['id' => $capture->id ]) }}">
                    <i class="fas fa-file" style="width:15; height:15;"></i>
                    Descargar</a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="{{ route('capture.show_storage', ['id' => $capture->id ]) }}" target="_blank"> 
                      <i class="fas fa-external-link-alt" style="width:15; height:15;"></i> Abrir</a>
                </div>
            @endif
       
    </div>
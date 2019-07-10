{{-- <div class="form-row">
    <div class="form-group col-md-6">
      <label for="construction_id">Obra</label>
      <select class="form-control" required name="construction_id" id="construction_id">
        @foreach($constructions as $construction)
        <option value="{{$construction->id}}"
            @if($construction->id == $capture->construction->id)
                selected
            @endif>{{$construction->name}}</option>
        @endforeach
    </select>
    </div>

    <div class="form-group col-md-6">
      <label for="provider_id">Proveedor</label>
      <select class="form-control" required name="provider_id" id="provider_id">
        @foreach($providers as $provider)
        <option value="{{$provider->id}}"
            @if($provider->id == $capture->provider->id)
                selected
            @endif>{{$provider->name}}  -  {{$provider->category}}</option>
        @endforeach
    </select>
    </div>
  </div> --}}

  <div class="form-row">
      <div class="form-group col-md-6">
        <label for="date">Fecha</label>
        <input type="date" class="form-control" required name="date" id="date" value="{{ $capture->date }}">
      </div>
  </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="folio">Folio</label>
          <input type="number" class="form-control" name="folio" id="folio" value="{{ $capture->folio }}">
      </div>
      <div class="form-group col-md-6">
        <label for="concept">Concepto</label>
        <input type="text" class="form-control" required name="concept" id="concept" value="{{ $capture->concept }}">
      </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="honorarium">Honorario</label>
            <br>
            <input type="radio" name="honorarium" id="honorarium" value="1"
            @if($capture->honorarium == 1)
                checked
            @endif> Si<br>
            <input type="radio" name="honorarium" id="honorarium" value="0"
            @if($capture->honorarium == 0)
                checked
            @endif> No<br>
        </div>
        <div class="form-group col-md-3">
            <label for="iva">Iva</label>
            <br>
            <input type="radio" name="iva" id="iva" value="1"
            @if($capture->iva == 1)
                checked
            @endif> Si<br>
            <input type="radio" name="iva" id="iva" value="0"
            @if($capture->iva == 0)
                checked
            @endif> No<br>
        </div>
    </div>

      <div class="form-row">
          <div class="form-group col-md-6">
            <label for="voucher">Agregar/reemplazar comprobante</label>
              <input type="file" class="form-control" name="voucher" id="voucher">
          </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="fund_id">Seleccione el fondo</label>
            <select class="form-control" required name="fund_id" id="fund_id">
                @foreach($funds as $fund)
                    <option value={{$fund->id}}
                        @if ($fund->id == $capture->fund->id)
                            selected
                        @endif>{{$fund->construction->name}} - {{$fund->date}}: ${{$fund->remaining}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

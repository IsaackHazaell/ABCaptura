<!-- Modal -->
<div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agregar producto Proveedor: {{$provider}}</h4>
      </div>
      <form action="{{route('capture.saveProduct')}}" method="POST">
          {{csrf_field()}}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="modal-body">
            <input type="hidden" name="id" id="id">
            <input type="hidden" name="provider_id" id="provider_id" value={{$provider}}>

            <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="concept">Concepto</label>
                  <input type="text" class="form-control" placeholder="cemento" required name="concept" id="concept">
                </select>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="description">Descripción adicional</label>
                  <input type="text" class="form-control" name="description" id="description">
                </div>
              </div>
            @include('price.partials.form')

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
      </form>

    </div>
  </div>
</div>

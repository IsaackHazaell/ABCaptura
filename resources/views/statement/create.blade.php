@extends('admin.layout')
@section('content')

<section class="content-header">
  <h1>
    Crear Estado de cuenta
  </h1>
  <br>
</section>

<form action="{{url('statement')}}" method="post">
  {{csrf_field()}}
  <div class="form-group col-md-6">
    <label class="required" for="construction_id">Selecciona obra</label>
    <select class="form-control" name="construction_id" id="construction_id">
            @foreach($constructions as $construction)
            <option value={{$construction->id}}>{{$construction->name}}</option>
            @endforeach
    </select>
  </div>
  
  <div class="form-group col-md-6">
    <label for="status" class="required">Seleccione el Estatus</label>
    <select class="form-control" name="status" id="status">
      <option value="1">Activo</option>
      <option value="0">Liquidado</option>
    </select>
  </div>

  <div class="form-group col-md-6">
      <label for="status" class="required">Seleccione la categoría del proveedor</label>
      <select class="form-control" required name="category" id="category" onchange="clearInputs()">
          <option value="0">Mano de obra o logística</option>
           <option value="1">Material</option>
      </select>
    </div>

  <div class="form-group col-md-6" id="lbl_provider_id">
      <label class="required" for="provider_id">Selecciona proveedor</label>
      <select class="form-control" required name="provider_id" id="provider_id">
              @foreach($providers as $provider)
              <option value={{$provider->id}}>{{$provider->name}}</option>
              @endforeach
      </select>
    </div>

    <div id="div_material">
      <div class="form-group col-md-6">
        <label class="required" for="name" class="required">Nombre del estado de cuenta</label>
        <input type="text" class="form-control" name="name" id="name">
      </div>
      
      <div class="form-group col-md-6">
        <label class="required" for="provider_material">Selecciona los proveedores</label>
        <select class="form-control" multiple="multiple" name="provider_material[]" id="provider_material" required>
          @foreach($category as $cat)
            <option value={{$cat->id}}>{{$cat->name}}</option>
          @endforeach
        </select>
      </div>
    </div>

  <div class="form-group col-md-6">
    <label for="total" class="required">Total</label>
    <input type="number" step="any" class="form-control" name="total" id="total" required>
  </div>

  <div class="form-group col-md-12">
    <br><button type="submit" class="btn btn-success">Guardar</button>
    <a class="btn btn-primary btn-md addNew" style="float: right;" href="{{ url('statement') }}"><b>Lista de estados de cuenta</b></a>
  </div>
</form>
@endsection

{{-- <script>
  var select = document.getElementById('status');
  select.onchange = function(){
      this.form.submit();
  };
</script> --}}

@section('adminlte_js')
  <script>
    $("#construction_id").select2();
    $("#provider_id").select2();
  </script>
  @include('statement.partials.script')
  @include('statement.partials.script_create')
@stop

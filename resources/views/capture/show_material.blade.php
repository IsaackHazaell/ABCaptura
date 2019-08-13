@extends('admin.layout')
@section('content')
    <section class="content-header">
      <h1>
        Captura
      </h1>
    </section>
    <div class="form-row">
        <div class="box-body">
            @include('capture.partials.form_show')
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

    <div class="form-group col-md-12">
      <a class="btn btn-primary btn-md addNew" style="float: right;" href="{{ url('capture') }}"><b>Lista de Capturas</b></a><br><br>
    </div>
  </div>
@endsection

@section('adminlte_js')
    @include('capture.partials.script_show')
@stop

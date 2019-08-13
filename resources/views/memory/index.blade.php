@extends('admin.layout')

@section('adminlte_css')
  <meta name="csrf-token" = content="{{ csrf_token() }}">
@stop

@section('content-header')
  <h1>
    Memoria
  </h1>
@stop

@section('content')
      <h2>Memoria</h2>
      <h3>{{ $contruction->name }} - {{ $date }}</h3>
      <h3>Suma de fondos del mes: ${{ number_format($total_funds) }}</h3>

      <div class="form-row">
            <div class="form-group col-md-12">
                <br>
            </div>
            <div class="form-group col-md-12">
                <h4>Con honorarios (%{{ $contruction->honorary }})</h4>
            </div>
      </div>

            <div class="box-body">
                <table id="memory_table_honorary" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Concepto</th>
                        <th>Categoría</th>
                        <th>Factura</th>
                        <th>Total</th>
                        <th>Folio</th>
                    </tr>
                </thead>
            </table>

            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="total_with_h">Total con honorarios</label>
                    <input type="text" class="form-control" name="total_with_h" id="total_with_h" readonly>
              </div>
            </div>

            <div class="form-row">
                  <div class="form-group col-md-12">
                      <br>
                  </div>
            </div>

            <div class="form-row">
                  <div class="form-group col-md-12">
                      <br>
                      <h4>Sin honorarios:</h4>
                  </div>
            </div>

            <div class="box-body">
                <table id="memory_table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Concepto</th>
                        <th>Categoría</th>
                        <th>Factura</th>
                        <th>Total</th>
                        <th>Folio</th>
                    </tr>
                </thead>
            </table>
            </div>

            <div class="form-row">
                <div class="form-group col-md-8">
                  <label for="total_without_h">Total sin honorarios</label>
                  <input type="text" class="form-control" name="total_without_h" id="total_without_h" readonly>
              </div>
            </div>

            <div class="form-row">
                  <div class="form-group col-md-12">
                      <br>
                  </div>
            </div>

          <div class="form-row">
              <div class="form-group col-md-12">
                <label for="total_memory">Total de memoria</label>
                <input type="text" class="form-control" name="total_memory" id="total_memory" readonly>
              </div>
          </div>

          <div class="form-row"style="float: right;">
            <div class="col-md-12">
              <form class="btn btn" action="{{route ('memory.pdf')}}" method="post">
                @csrf
                <input type="hidden" name="name" value="{{ $contruction->name }}">
                <input type="hidden" name="honorary" value="{{ $contruction->honorary }}">
                <input type="hidden" name="total_funds" value="{{ $total_funds }}">
                <input type="hidden" name="date" value="{{ $date }}">
                <input type="hidden" name="construction_id" value="{{ $construction_id }}">
                <button class="btn btn float-right" type="submit" name="button" ><i class="far fa-file-pdf"> Exportar</i></button>
              </form>

          </div>
          </div>

      </div>
@stop

@section('adminlte_js')
    @include('memory.partials.script')
@stop

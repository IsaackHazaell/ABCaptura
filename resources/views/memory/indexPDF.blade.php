<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<div class="form-row">
  <div class="form-group col-md-6">
    <h3>Memoria</h3>
    <h4>{{ $contruction->name }} - {{ $date }}</h4>
    <h4>Suma de fondos del mes: ${{ number_format($total_funds) }}</h4>
  </div>
  <div class="col-md-6">
    <img src="img/ablogo.jpg" alt="" width="120" style="float: right;">
  </div>
</div>



<div class="form-row">
      <div class="form-group col-md-12">
          <br>
                <h5>Con honorarios ({{ $contruction->honorary }}%)</h5>
            </div>
      </div>

            <div class="box-body">
                <table id="memory_table_honorary" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Proveedor</th>
                        <th>Concepto</th>
                        <th>Factura</th>
                        <th>Total</th>
                        <th>Folio</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($table2 as $honorarios)
                    <tr>
                      <td>{{$honorarios->capture_date}}</td>
                      <td>{{$honorarios->provider_name}}</td>
                      <td>{{$honorarios->capture_concept}}</td>
                      <td>{{$honorarios->voucher}}</td>
                      <td>{{number_format($honorarios->capture_total)}}</td>
                      <td>{{$honorarios->capture_folio}}</td>
                    </tr>
                    {{number_format($totalMH += $honorarios->capture_total)}}
                  @endforeach
                </tbody>
            </table>

            <div>
              <br>
            </div>

            <br>

            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="total_with_h">Total con honorarios</label>
                    <label for="">:&nbsp;&nbsp; ${{number_format($totalMH)}}</label>
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
                      <h5>Sin honorarios:</h5>
                  </div>
            </div>

            <div class="box-body">
                <table id="memory_table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Proveedor</th>
                        <th>Concepto</th>
                        <th>Factura</th>
                        <th>Total</th>
                        <th>Folio</th>
                    </tr>
                </thead>

                @foreach ($table1 as $simple)
                  <tr>
                    <td>{{$simple->capture_date}}</td>
                    <td>{{$simple->provider_name}}</td>
                    <td>{{$simple->capture_concept}}</td>
                    <td>{{$simple->voucher}}</td>
                    <td>{{number_format($simple->capture_total)}}</td>
                    <td>{{$simple->capture_folio}}</td>
                  </tr>

                  {{$totalM += $simple->capture_total}}
                @endforeach
            </table>
            </div>
            <div>
              <br>
            </div>

            <br>
            <div class="form-row">
                <div class="form-group col-md-8">
                  <label for="total_without_h">Total sin honorarios</label>
                  <label for="">:&nbsp;&nbsp; ${{number_format($totalM)}}</label>
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
                <label for="">:&nbsp;&nbsp; ${{number_format($totalM+$totalMH)}}</label>

              </div>
          </div>

      </div>

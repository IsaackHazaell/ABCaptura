@extends('admin.layout')

@section('adminlte_css')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <meta name="csrf-token" = content="{{ csrf_token() }}">
@stop

@section('content-header')
  <h1>
    Obras
  </h1>
@stop

@section('content')
      <h2>Lista de Obras</h2>

      <a class="btn btn-success btn-md addNew" style="float: right;" href="{{ url('construction/create') }}"><b>Agregar Nuevo</b></a><br><br>

      <div class="box-body">
          <table id="constructions_table" class="table table-striped table-bordered" style="width:100%">
          <thead>
              <tr>
                  <th width="10px">Id</th>
                  <th>Nombre</th>
                  <th>Honorario</th>
                  <th>Fecha</th>
                  <th>Metros cuadrados</th>
                  <th>Estatus</th>
                  <th width="50px">Acciones</th>
              </tr>
          </thead>
      </table>
      </div>

@include('construction.modal')

@stop

@section('adminlte_js')
  <script>

  $('#edit').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var id = button.data('idconstruction')
      var name = button.data('nameconstruction')
      var honorary = button.data('honoraryconstruction')
      var date = button.data('dateconstruction')
      var square_meter = button.data('square_meterconstruction')
      var status = button.data('statusconstruction')

      //var data_id = button.data('iddata')
      var modal = $(this)
      modal.find('.modal-body #id').val(id);
      modal.find('.modal-body #name').val(name);
      modal.find('.modal-body #honorary').val(honorary);
      modal.find('.modal-body #date').val(date);
      modal.find('.modal-body #square_meter').val(square_meter);
      modal.find('.modal-body #status').val(status);
      //modal.find('.modal-body #data_id').val(data_id);
  });


  </script>



  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script>
      $(document).ready(function() {
          $('#constructions_table').DataTable({
              "processing": true,
              "serverSide": true,
              "ajax": "{{route('construction.showTableC')}}",
              "columns": [
                  {data: 'id'},
                  {data: 'name'},
                  {data: 'honorary'},
                  {data: 'date'},
                  {data: 'square_meter'},
                  {data: 'status'},
                  {data: 'btn'}
              ],
              "language": {
                "info": "_TOTAL_ registros",
                "search": "Buscar",
                "paginate": {
                  "next": "Siguiente",
                  "previous": "Anterior",
                },
                "lengthMenu": 'Mostrar <select>'+
                    '<option value="10">10</option>'+
                    '<option value="30">30</option>'+
                    '<option value="-1">Todos</option>'+
                    '</select> registros',
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "emptyTable": "No hay datos",
                "zeroRecords": "No hay coincidencias",
                "infoEmpty": "",
                "infoFiltered": ""
              }/*,
              "initComplete":function(settings, json){
      console.log(json);
    }*/
          });


      });


  </script>

  <script>/*
  swal({
      "timer":1800,
      "title":"Título",
      "text":"Notificación Básica",
      "showConfirmButton":false
  });*/
  </script>
@stop

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


        <a href="{{ url('construction/create') }}" class="btn btn-success"
        style="Position:Absolute; left:93%; top:13%;">
          <i class="fas fa-plus-square"></i> Agregar</a>


      <div class="box-body">
          <table id="constructions_table" class="table table-striped table-bordered" style="width:100%">
          <thead>
              <tr>
                  <th width="10px">Id</th>
                  <th>Nombre</th>
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

  // function delete(id)
  // {
  //   var csrf_token=$('meta[name="csrf-token"]').attr('content');
  //   swal({
  //     title: "Estás seguro?",
  //     text: "Se eliminará el constructione",
  //     icon: "warning",
  //     buttons: true,
  //     dangerMode: true,
  //   })
  //   .then((willDelete) => {
  //     if (willDelete) {
  //       $.ajax({
  //         url: "{{url('/construction')}}" + '/' + id,
  //           type: "POST",
  //           data: {'_method' : 'DELETE', '_token' : csrf_token},
  //           success: function (data) {
  //             //constructions_table.ajax.reload();
  //             swal("constructione eliminado exitosamente", {
  //               icon: "success",
  //             });
  //             }
  //       });
  //
  //     };
  //   });
  // }

  $('#edit').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var id = button.data('idconstruction')
      var name = button.data('nameconstruction')
      var status = button.data('statusconstruction')

      //var data_id = button.data('iddata')
      var modal = $(this)
      modal.find('.modal-body #id').val(id);
      modal.find('.modal-body #name').val(name);
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

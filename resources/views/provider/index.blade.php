@extends('admin.layout')

@section('adminlte_css')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <meta name="csrf-token" = content="{{ csrf_token() }}">
@stop

@section('content-header')
  <h1>
    Proveedores
  </h1>
@stop

@section('content')
      <h2>Lista de Proveedores</h2>


        <a href="{{ url('provider/create') }}" class="btn btn-success"
        style="Position:Absolute; left:93%; top:13%;">
          <i class="fas fa-plus-square"></i> Agregar</a>


      <div class="box-body">
          <table id="providers_table" class="table table-striped table-bordered" style="width:100%">
          <thead>
              <tr>
                  <th width="10px">Id</th>
                  <th>Nombre</th>
                  <th>Teléfono 1</th>
                  <th>Correo</th>
                  <th width="120px">Acciones</th>
              </tr>
          </thead>
      </table>
      </div>


      @include('provider.modal')

@stop

@section('adminlte_js')
  <script>

  /*function add(id)
  {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
      title: "Estás seguro?",
      text: "Se eliminará el cliente",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: "{//{url('/client')}}" + '/' + id,
            type: "POST",
            data: {'_method' : 'DELETE', '_token' : csrf_token},
            success: function (data) {
              //clients_table.ajax.reload();
              swal("Cliente eliminado exitosamente", {
                icon: "success",
              });
              }
        });

      };
    });
  }

  $('#edit').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var id = button.data('idclient')
      var name = button.data('nameclient')
      var lastname = button.data('lastnameclient')
      var phone1 = button.data('phone1client')
      var phone2 = button.data('phone2client')
      var email = button.data('emailclient')
      var prestige = button.data('prestigeclient')
      var comments = button.data('commentsclient')
      var data_id = button.data('iddata')
      var modal = $(this)
      modal.find('.modal-body #cli_id').val(id);
      modal.find('.modal-body #name').val(name);
      modal.find('.modal-body #lastname').val(lastname);
      modal.find('.modal-body #phone1').val(phone1);
      modal.find('.modal-body #phone2').val(phone2);
      modal.find('.modal-body #email').val(email);
      modal.find('.modal-body #prestige').val(prestige);
      modal.find('.modal-body #comments').val(comments);
      modal.find('.modal-body #data_id').val(data_id);
  });
*/

  </script>



  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script>
      $(document).ready(function() {
          $('#providers_table').DataTable({
              "processing": true,
              "serverSide": true,
              "ajax": "{{route('provider.showTable')}}",
              "columns": [
                  {data: 'id'},
                  {data: 'name'},
                  {data: 'phone'},
                  {data: 'mail'},
                  {data: 'btn'}
              ],
              "language": {
                "info": "_TOTAL_ registros",
                "search": "Buscar",
                "paginate": {
                  "next": "Siguinte",
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

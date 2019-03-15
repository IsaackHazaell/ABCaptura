@extends('admin.layout')

@section('adminlte_css')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <meta name="csrf-token" = content="{{ csrf_token() }}">
@stop

@section('content-header')
  <h1>
    Fondos
  </h1>
@stop

@section('content')
      <h2>Lista de Fondos</h2>


        <a href="{{ url('provider/create') }}" class="btn btn-success"
        style="Position:Absolute; left:93%; top:13%;">
          <i class="fas fa-plus-square"></i> Agregar</a>


      <div class="box-body">
          <table id="funds_table" class="table table-striped table-bordered" style="width:100%">
          <thead>
              <tr>
                  <th width="10px">Id</th>
                  <th>Construcción</th>
                  <th>Total</th>
                  <th width="120px">Acciones</th>
              </tr>
          </thead>
      </table>
      </div>


      @include('fund.modal')

@stop

@section('adminlte_js')
  <script>

  function delete(id)
  {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
      title: "Estás seguro?",
      text: "Se eliminará el fondo",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: "{{url('/fund')}}" + '/' + id,
            type: "POST",
            data: {'_method' : 'DELETE', '_token' : csrf_token},
            success: function (data) {
              //providers_table.ajax.reload();
              swal("fondo eliminado exitosamente", {
                icon: "success",
              });
              }
        });

      };
    });
  }

  $('#edit').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var id = button.data('idfund')
      var name = button.data('namefund')
      var total = button.data('totalfund')

      var modal = $(this)
      modal.find('.modal-body #id').val(id);
      modal.find('.modal-body #name').val(name);
      modal.find('.modal-body #total').val(total);
  });


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
              "ajax": "{{route('fund.showTable')}}",
              "columns": [
                  {data: 'id'},
                  {data: 'name'},
                  {data: 'total'},
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
              }
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

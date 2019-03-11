@extends('admin.layout')

@section('adminlte_css')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <meta name="csrf-token" = content="{{ csrf_token() }}">
@stop

@section('content-header')
  <h1>
    Precios unitarios
  </h1>
@stop

@section('content')
      <h2>Lista de Productos</h2>


        <a href="{{ url('unitPrice/create') }}" class="btn btn-success"
        style="Position:Absolute; left:93%; top:13%;">
          <i class="fas fa-plus-square"></i> Agregar</a>


      <div class="box-body">
          <table id="unitPrices_table" class="table table-striped table-bordered" style="width:100%">
          <thead>
              <tr>
                  <th width="10px">Id</th>
                  <th>Proveedor</th>
                  <th>Nombre</th>
                  <th>Año</th>
                  <th>Costo</th>
                  <th>Unidad</th>
                  <th width="120px">Acciones</th>
              </tr>
          </thead>
      </table>
      </div>

@include('unitPrice.partials.script')
      @include('provider.modal')
@include('unitPrice.partials.script')
@stop

@section('adminlte_js')
  @include('unitPrice.partials.script')
  <script>



  /*function delete(id)
  {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
      title: "Estás seguro?",
      text: "Se eliminará el providere",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: "{//{url('/provider')}}" + '/' + id,
            type: "POST",
            data: {'_method' : 'DELETE', '_token' : csrf_token},
            success: function (data) {
              //providers_table.ajax.reload();
              swal("providere eliminado exitosamente", {
                icon: "success",
              });
              }
        });

      };
    });
  }

  $('#edit').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var id = button.data('idprovider')
      var name = button.data('nameprovider')
      var turn = button.data('turnprovider')
      var phone = button.data('phoneprovider')
      var mail = button.data('mailprovider')

      var street = button.data('streetprovider')
      var colony = button.data('colonyprovider')
      var town = button.data('townprovider')
      var state = button.data('stateprovider')
      //var data_id = button.data('iddata')
      var modal = $(this)
      modal.find('.modal-body #id').val(id);
      modal.find('.modal-body #name').val(name);
      modal.find('.modal-body #turn').val(turn);
      modal.find('.modal-body #phone').val(phone);
      modal.find('.modal-body #mail').val(mail);

      modal.find('.modal-body #street').val(street);
      modal.find('.modal-body #colony').val(colony);
      modal.find('.modal-body #town').val(town);
      modal.find('.modal-body #state').val(state);
      //modal.find('.modal-body #data_id').val(data_id);
  });
*/

  </script>



  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  @include('unitPrice.partials.script')
  <script>

  var table = $('#unitPrices_table').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": "{{route('unitPrice.showTable')}}",
      "columns": [
          {data: 'id'},
          {data: 'provider_id'},
          {data: 'name'},
          {data: 'year'},
          {data: 'cost'},
          {data: 'unit'},
          {data: 'btn'}
      ],
      /*,"language": {
                  url: "{//{ asset('/plugins/datatables/spanish.json') }}"
              }*/
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

  /*$('body').delegate('.status-customer','click',function(){
        id_customer = $(this).attr('id_customer');

        swal({
          title: "Estás seguro?",
          text: "Se eliminará el providere",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
                /*url: "{//{url('/provider')}}" + '/' + id,
                type: "POST",
                data: {'_method' : 'DELETE', '_token' : csrf_token},
                url: '/unitPrice/' + id_customer ,
                type: 'DELETE',
                dataType: 'json',
                data: {id: id_customer}
                success: function (data) {
                  //providers_table.ajax.reload();
                  swal("providere eliminado exitosamente", {
                    icon: "success",
                  });
                  loadDatatable();
                  }
            });

          };
          });
}*/

$('body').delegate('.status-customer','click',function(){
        id_customer = $(this).attr('id_customer');
        console.log(id_customer);
        swal({
            /*title: 'Está seguro?',
            text: "Quiéres eliminar esté cliente?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Si!'*/
            title: "Estás seguro?",
            text: "Se eliminará el providere",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then(function () {
            $.ajax({
                url: '/unitPrice/' + id_customer ,
                type: 'DELETE'
                //dataType: 'json',
                //data: {id: id_customer}
            }).done(function(data){
                console.log(data);
                sAlert(data.title, data.type, data.text);
                loadDatatable();
            });
        });
    });//BUTTON

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

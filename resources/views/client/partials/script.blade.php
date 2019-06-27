<script>
//DATATABLE
var table=null;
table = $('#clients_table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "{{route('client.showTableCl')}}",
    "columns": [
        {data: 'name'},
        {data: 'email'},
        {data: 'cellphone'},
        {data: 'phonelandline'},
        {data: 'address'},
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
}
});


//EDIT
$('#edit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('idclient')
    var name = button.data('nameclient')
    var cellphone = button.data('phoneclient')
    var email = button.data('emailclient')
    var phonelandline = button.data('phonelandlineclient')
    var address = button.data('addressclient')
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #name').val(name);
    modal.find('.modal-body #cellphone').val(cellphone);
    modal.find('.modal-body #phonelandline').val(phonelandline);
    modal.find('.modal-body #address').val(address);
    modal.find('.modal-body #email').val(email);
});


//DELETE
$('body').delegate('.delete','click',function(){
        id_client = $(this).attr('id_client');
        var csrf_token=$('meta[name="csrf-token"]').attr('content');
        swal({
            title: "Estás seguro?",
            text: "Se eliminará el proveedor",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            $.ajax({
                url: "{{url('/client')}}" + '/' + id_client,
                headers: {'X-CSRF-TOKEN': csrf_token},
                type: 'DELETE',
                dataType: 'json',
                data: {id: id_client}
            }).done(function(data){
              table.ajax.reload();
              sAlert(data.title, data.text, data.icon);
            });
          }
        });
    });


//SWETALERT
@if (Session::has('message'))
        sAlert(
        "{{ Session::get('message.title') }}",
        "{{ Session::get('message.text') }}",
        "{{ Session::get('message.icon') }}"
    );
@endif

function sAlert(title, text, icon)
{
  swal({
    title: title,
    text: text,
    icon: icon,
    button: "Continue",
    timer: 3000
  });
}
</script>

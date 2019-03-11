<script>
//DATATABLE
var table=null;
table = $('#providers_table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "{{route('provider.showTableP')}}",
    "columns": [
        {data: 'id'},
        {data: 'name'},
        {data: 'turn'},
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
    }
});


//EDIT
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
});


//DELETE
$('body').delegate('.status-provider','click',function(){
        id_provider = $(this).attr('id_provider');
        var csrf_token=$('meta[name="csrf-token"]').attr('content');
        swal({
            title: "Estás seguro?",
            text: "Se eliminará el proveedor",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then(function () {
            $.ajax({
                url: "{{url('/provider')}}" + '/' + id_provider,
                headers: {'X-CSRF-TOKEN': csrf_token},
                type: 'DELETE',
                dataType: 'json',
                data: {id: id_provider}
            }).done(function(data){
              table.ajax.reload();
              sAlert(data.title, data.text, data.icon);
            });
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

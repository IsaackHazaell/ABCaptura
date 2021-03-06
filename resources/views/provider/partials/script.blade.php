<script>
//DATATABLE
var table=null;
table = $('#providers_table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "{{route('provider.showTableP')}}",
    "columns": [
        {data: 'name'},
        {data: 'category'},
        {data: 'turn'},
        {data: 'company'},
        {data: 'cellphone'},
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
    var id = button.data('idprovider')
    var name = button.data('nameprovider')
    var turn = button.data('turnprovider')
    var company = button.data('companyprovider')
    var category = button.data('categoryprovider')
    var rfc = button.data('rfcprovider')
    category = toCategory(category);
    if(category == "1")
    {
      document.getElementById('rfc_div').style.display='block';
    }
    else
      document.getElementById('rfc_div').style.display='none';
    var phone = button.data('phoneprovider')
    var phone2 = button.data('phonlandlineprovider')
    var mail = button.data('mailprovider')
    var street = button.data('streetprovider')
    var colony = button.data('colonyprovider')
    var town = button.data('townprovider')
    var state = button.data('stateprovider')
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #name').val(name);
    modal.find('.modal-body #turn').val(turn);
    modal.find('.modal-body #company').val(company);
    modal.find('.modal-body #category').val(category);
    modal.find('.modal-body #cellphone').val(phone);
    modal.find('.modal-body #phonlandline').val(phone2);
    modal.find('.modal-body #mail').val(mail);
    modal.find('.modal-body #street').val(street);
    modal.find('.modal-body #colony').val(colony);
    modal.find('.modal-body #town').val(town);
    modal.find('.modal-body #state').val(state);
    modal.find('.modal-body #rfc').val(rfc);
});


function toCategory(category) {
    if(category == "Mano de obra")
      category = 0;
    else if(category == "Material")
      category = 1;
      else if(category == "Logística")
        category = 2;

    return category;
}


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
        }).then((willDelete) => {
          if (willDelete) {
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

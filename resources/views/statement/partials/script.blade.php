<script>

var table=null;
table = $('#statements_table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{route('statement.showTableSt')}}",
        "columns": [
            {data: 'construction_name'},
            {data: 'provider_name'},
            {data: 'status'},
            {data: 'total'},
            {data: 'remaining'},
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
    var id = button.data('idstatement')
    var construction = button.data('nameconstruction')
    var provider = button.data('nameprovider')
    var status = button.data('statusstatement')
    if(status == "Activo")
    {
      status = 1;
    }
    else
    {
      status = 0;
    }
    var total = button.data('totalstatement')
    var remaining = button.data('remainingstatement')

    //var data_id = button.data('iddata')
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #construction_id').val(construction)
    modal.find('.modal-body #provider_id').val(provider)
    modal.find('.modal-body #status').val(status);
    modal.find('.modal-body #total').val(total);
    modal.find('.modal-body #remaining').val(remaining);

    //modal.find('.modal-body #data_id').val(data_id);
});

//DELETE
$('body').delegate('.status-statement','click',function(){
        id_statement = $(this).attr('id_statement');
        var csrf_token=$('meta[name="csrf-token"]').attr('content');
        swal({
            title: "Estás seguro?",
            text: "Se eliminará el estado de cuenta",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            $.ajax({
                url: "{{url('/statement')}}" + '/' + id_statement,
                headers: {'X-CSRF-TOKEN': csrf_token},
                type: 'DELETE',
                dataType: 'json',
                data: {id: id_statement}
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

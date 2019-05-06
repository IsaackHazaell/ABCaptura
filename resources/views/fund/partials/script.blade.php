<script>
//DATATABLE
var table=null;
table = $('#funds_table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "{{route('fund.showTableF')}}",
    "columns": [
        {data: 'fund_id'},
        {data: 'name'},
        {data: 'date'},
        {data: 'remaining'},
        {data: 'total'},
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
    var id = button.data('idfund')
    var name = button.data('name')
    var date = button.data('date')
    var remaining = button.data('remaining')
    var total = button.data('total')
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #name').val(name);
    modal.find('.modal-body #date').val(date);
    modal.find('.modal-body #remaining').val(remaining);
    modal.find('.modal-body #total').val(total);
});

//DELETE
$('body').delegate('.status-fund','click',function(){
        id_fund = $(this).attr('id_fund');
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
                url: "{{url('/fund')}}" + '/' + id_fund,
                headers: {'X-CSRF-TOKEN': csrf_token},
                type: 'DELETE',
                dataType: 'json',
                data: {id: id_fund}
            }).done(function(data){
              table.ajax.reload();
              sAlert(data.title, data.text, data.icon);
            });
          }
        });
    });

//EDIT
$('#edit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('idfund')
    var construction_id = button.data('construction_id')
    var date = button.data('date')
    var remaining = button.data('remaining')
    var total = button.data('total')

    var data_id = button.data('iddata')
    var modal = $(this)
    modal.find('.modal-body #idfund').val(id);
    modal.find('.modal-body #construction_id').val(construction_id);
    modal.find('.modal-body #date').val(date);
    modal.find('.modal-body #remaining').val(remaining);
    modal.find('.modal-body #total').val(total);

    // modal.find('.modal-body #data_id').val(data_id);
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

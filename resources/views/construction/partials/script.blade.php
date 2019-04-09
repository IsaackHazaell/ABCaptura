<script>

$(document).ready(function() {
    $('#constructions_table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{route('construction.showTableC')}}",
        "columns": [
            {data: 'construction_id'},
            {data: 'construction_name'},
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
        }
    });
});


$('#edit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('idconstruction')
    var name = button.data('nameconstruction')
    var honorary = button.data('honoraryconstruction')
    var date = button.data('dateconstruction')
    var square_meter = button.data('square_meterconstruction')
    var status = button.data('statusconstruction')

    var client_name = button.data('client_name')
    var cellphone = button.data('cellphone')
    var phonelandline = button.data('phonelandline')
    var address = button.data('address')

    //var data_id = button.data('iddata')
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #name').val(name);
    modal.find('.modal-body #honorary').val(honorary);
    modal.find('.modal-body #date').val(date);
    modal.find('.modal-body #square_meter').val(square_meter);
    modal.find('.modal-body #status').val(status);

    modal.find('.modal-body #client_name').val(client_name);
    modal.find('.modal-body #cellphone').val(cellphone);
    modal.find('.modal-body #phonelandline').val(phonelandline);
    modal.find('.modal-body #address').val(address);

    //modal.find('.modal-body #data_id').val(data_id);
});

//DELETE
$('body').delegate('.status-construction','click',function(){
        id_construction = $(this).attr('id_construction');
        var csrf_token=$('meta[name="csrf-token"]').attr('content');
        swal({
            title: "Estás seguro?",
            text: "Se eliminará la obra",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            $.ajax({
                url: "{{url('/construction')}}" + '/' + id_construction,
                headers: {'X-CSRF-TOKEN': csrf_token},
                type: 'DELETE',
                dataType: 'json',
                data: {id: id_construction}
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

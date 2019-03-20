<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
//DATATABLE
var table=null;
table = $('#unity_table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "{{route('unity.showTableU')}}",
    "columns": [
        {data: 'id'},
        {data: 'name'},
        {data: 'reference'},
        {data: 'equivalent'},
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
    var id = button.data('id')
    var name = button.data('name')
    var reference = button.data('reference')
    var equivalent = button.data('equivalent')

    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #name').val(name);
    modal.find('.modal-body #reference').val(reference);
    modal.find('.modal-body #equivalent').val(equivalent);

});


//DELETE
$('body').delegate('.status-unity','click',function(){
        id_unity = $(this).attr('id_unity');
        var csrf_token=$('meta[name="csrf-token"]').attr('content');
        swal({
            title: "Estás seguro?",
            text: "Se eliminará la unidad",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then(function () {
            $.ajax({
                url: "{{url('/unity')}}" + '/' + id_unity,
                headers: {'X-CSRF-TOKEN': csrf_token},
                type: 'DELETE',
                dataType: 'json',
                data: {id: id_unity}
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

<script>
//DATATABLE
var table=null;
table = $('#prices_table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "{{route('price.showTablePrice')}}",
    "columns": [
        {data: 'id'},
        {data: 'name_construction'},
        {data: 'concept_product'},
        {data: 'name_unity'},
        {data: 'price'},
        {data: 'year'},
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
    var provider_id = button.data('providerid')
    var concept = button.data('conceptproduct')
    var description = button.data('descriptionproduct')
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #provider_id').val(provider_id);
    modal.find('.modal-body #concept').val(concept);
    modal.find('.modal-body #description').val(description);
});


//DELETE
$('body').delegate('.status-price','click',function(){
        id_price = $(this).attr('id_price');
        var csrf_token=$('meta[name="csrf-token"]').attr('content');
        swal({
            title: "Estás seguro?",
            text: "Se eliminará el precio",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            $.ajax({
                url: "{{url('/price')}}" + '/' + id_price,
                headers: {'X-CSRF-TOKEN': csrf_token},
                type: 'DELETE',
                dataType: 'json',
                data: {id: id_price}
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

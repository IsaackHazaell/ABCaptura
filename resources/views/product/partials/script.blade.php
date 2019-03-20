<script>
//DATATABLE
var table=null;
table = $('#products_table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "{{route('product.showTableProduct')}}",
    "columns": [
        {data: 'id'},
        {data: 'concept'},
        {data: 'description'},
        {data: 'provider_id'},
        {data: 'category'},
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
    var id = button.data('idproduct')
    var name = button.data('nameproduct')
    var turn = button.data('turnproduct')
    var phone = button.data('phoneproduct')
    var mail = button.data('mailproduct')
    var street = button.data('streetproduct')
    var colony = button.data('colonyproduct')
    var town = button.data('townproduct')
    var state = button.data('stateproduct')
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
$('body').delegate('.status-product','click',function(){

        id_product = $(this).attr('id_product');
        //console.log(id_product);
        var csrf_token=$('meta[name="csrf-token"]').attr('content');
        swal({
            title: "Estás seguro?",
            text: "Se eliminará el producto",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            //console.log(id_product);
            $.ajax({
                url: "{{url('/product')}}" + '/' + id_product,
                headers: {'X-CSRF-TOKEN': csrf_token},
                type: 'DELETE',
                dataType: 'json',
                data: {id: id_product}
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

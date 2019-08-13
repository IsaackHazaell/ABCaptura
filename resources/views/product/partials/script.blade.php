<script>
//DATATABLE
var table=null;
table = $('#products_table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "{{route('product.showTableProduct')}}",
    "columns": [
        {data: 'concept'},
        {data: 'unity'},
        {data: 'price'},
        {data: 'month'},
        {data: 'year'},
        {data: 'name'},
        {data: 'description'},
        {data: 'btn'}
    ],
    "initComplete": function(settings, json) {
        var column = table.column( 4 );
                $('#providers').on('change', function () {
                    column.search($('#providers option:selected').text()).draw();
                    if($('#providers option:selected').text() == "Todos")
                    {
                      column.search($('#providers option:selected').val()).draw();
                    }
                });
             },
    "lengthMenu": [[-1, 10, 30, 60, 100], ["Todos", 10, 30, 60, 100]],
    "language": {
      "info": "_TOTAL_ registros",
      "search": "Buscar",
      "paginate": {
        "next": "Siguiente",
        "previous": "Anterior",
      },
      "lengthChange": false,
      "lengthMenu": 'Mostrar _MENU_ registros',

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
    var unity = button.data('unity')
    var price = button.data('price')
    var year = button.data('year')
    var month = button.data('month')
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #provider_id').val(provider_id);
    modal.find('.modal-body #concept').val(concept);
    modal.find('.modal-body #description').val(description);
    modal.find('.modal-body #unity').val(unity);
    modal.find('.modal-body #price').val(price);
    modal.find('.modal-body #year').val(year);
    modal.find('.modal-body #month').val(month);
});

function monthAt(month) {
  var monthGood="";
  for (var i = 0; i < month.length; i++) {
   if(month[i] == " ")
    break;
    else {
      monthGood += month[i];
    }
  }
  if(monthGood == "Enero")
    month = 1;
  else if(monthGood =="Febrero")
    month = 2;
    else if(monthGood =="Marzo")
      month = 3;
      else if(monthGood =="Abril")
        month = 4;
        else if(monthGood =="Mayo")
          month = 5;
          else if(monthGood =="Junio")
            month = 6;
            else if(monthGood =="Julio")
              month = 7;
              else if(monthGood =="Agosto")
                month = 8;
                else if(monthGood =="Septiembre")
                  month = 9;
                  else if(monthGood == "Octubre")
                    month = 10;
                    else if(monthGood == "Noviembre")
                      month = 11;
                      else if(monthGood == "Diciembre")
                        month = 12;
  return month;
}


//DELETE
$('body').delegate('.status-product','click',function(){
        id_product = $(this).attr('id_product');
        var csrf_token=$('meta[name="csrf-token"]').attr('content');
        swal({
            title: "Estás seguro?",
            text: "Se eliminará el producto",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
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

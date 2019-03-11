@push('scripts')
<script>
var table = $('#unitPrices_table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "{{route('unitPrice.showTable')}}",
    "columns": [
        {data: 'id'},
        {data: 'provider_id'},
        {data: 'name'},
        {data: 'year'},
        {data: 'cost'},
        {data: 'unit'},
        {data: 'btn'}
    ],
    /*"language": {
                url: "{//{ asset('/plugins/datatables/spanish.json') }}"
            },
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
    }*/
});

    $(document).ready(function(){


      var table = $('#unitPrices_table').DataTable({
        console.log("Entra?");
          "processing": true,
          "serverSide": true,
          "ajax": "{{route('unitPrice.showTable')}}",
          "columns": [
              {data: 'id'},
              {data: 'provider_id'},
              {data: 'name'},
              {data: 'year'},
              {data: 'cost'},
              {data: 'unit'},
              {data: 'btn'}
          ],
          /*"language": {
                      url: "{//{ asset('/plugins/datatables/spanish.json') }}"
                  },
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
          }*/
      });
      console.log("Entra?");

        $('body').delegate('#btnDeleteProd','mouseenter',function(){
            product_id = $(this).attr('product_id');
            var token = $("#token").val();
            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                title: "¿Está seguro?",
                singleton: true,
                popout: true,
                btnOkLabel: 'Sí',
                btnCancelLabel: 'No',
                placement: 'left',
                onConfirm: function() {
                    $.ajax({
                        url: '/products/' + product_id,
                        headers: {'X-CSRF-TOKEN': token},
                        type: 'DELETE',
                        dataType: 'json',
                        data: {id: product_id}
                    }).done(function(data){
                        sAlert('Eliminado', 'success', data.message);
                        table.ajax.reload();
                    }).fail(function(data){
                        sAlert('Error', 'error', "Problemas al eliminar el producto.");
                    });
                },
            });
        });

        $('body').delegate('#msj-authorized','click', function(){
            $(this).hide();
        });
    });

    @if (Session::has('message'))
        sAlert(
            "{{ Session::get('message.title') }}",
            "{{ Session::get('message.type') }}",
            "{{ Session::get('message.text') }}"
        );
    @endif

    function sAlert(title, type, text)
    {
        swal({
            title: title,
            type: type,
            text: text,
            confirmButtonText: "Continuar",
            timer: 3000
        });
    }
</script>
@endpush

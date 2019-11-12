<script>
    $(document).ready(function () {
      castearInputProduct();
      var table=null;
      chargeTable1();
    });


    function chargeTable1()
    {
        var price = $('#priceCapture').val();
        table = $('#edit_products_capture_table').DataTable({
          "bDestroy": true,
          stateSave: true,
          "ordering": false,
          "processing": true,
        "serverSide": true,
        "ajax": "{{route('capture.showTableEPC', ['capture_id' => $data->id])}}",
        "columns": [
            {data: 'concept'},
            {data: 'unity'},
            {data: 'quantity'},
            {data: 'price'},
            {data: 'extra'},
            {data: 'total'},
            {data: 'btn'}
        ],
    
    "footerCallback": function ( row, data, start, end, display ) {
        var api = this.api(), data;
    
        // Remove the formatting to get integer data for summation
        var intVal = function ( i ) {
            return typeof i === 'string' ?
                i.replace(/[\$,]/g, '')*1 :
                typeof i === 'number' ?
                    i : 0;
        };
    
        // Total over all pages
        total = api
            .column( 5 )
            .data()
            .reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );
    
        if({{$data->iva}} == 1)
        {
            $('#subtotal_iva').val(total);
            getIva();
        }
        else
            $('#total').val(total);
    
    },
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
    cleanInputs();
    
    }

    
    function castearInputProduct()
    {
      var all = document.getElementById("product").value;
      var max = all.length;
      var price = 0
      for (var i = 0; i < max; i++) {
        if(all.charAt(i) == "/")
        {
          break;
        }
        price += all.charAt(i)
      }
      $('#priceCapture').val(price);
    
      var product_id=0;
      for (var i = price.length; i < max; i++) {
        if(all.charAt(i) == "/")
        {
          break;
        }
        product_id += all.charAt(i)
      }
      $('#product_id').val(product_id);
    
      var unity_id=0;
      for (var i = price.length+product_id.length; i < max; i++) {
        if(all.charAt(i) == "/")
        {
          break;
        }
        unity_id += all.charAt(i)
      }
      $('#unity_id').val(unity_id);
    
      var quantity = document.getElementById("quantity").value;
      var extra = document.getElementById("extra").value;
      var totalP = parseFloat(price * quantity) + parseFloat(extra);
      $('#total_product').val(totalP);
    }
    
    $('#product').on('change', function (event) {
      castearInputProduct();
    
    });
    
    $('#quantity').on('change', function (event) {
      castearInputProduct();
    
    });
    
    $('#extra').on('change', function (event) {
      castearInputProduct();
    
    });
    
    $("#prod").click(function (e) {
        e.preventDefault();
        chargeTable();
    });
    
    function chargeTable()
    {
        var price = $('#priceCapture').val();
        table = $('#edit_products_capture_table').DataTable({
          "bDestroy": true,
          stateSave: true,
          "ordering": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
              type: "get",
              url: "{{route('capture.addProductEdit')}}",
              data: {
                  price: $('#product').val(),
                  capture_id: $('#capture_id').val(),
                  quantity: $('#quantity').val(),
                  extra: $('#extra').val(),
                  total: $('#total_product').val()
              },
              "dataSrc": function ( json ) {
                    //Make your callback here.
                    console.log(json);
                    sAlert('Agregado!', 'Agregado exitosamente', 'success');
                    return json.data;
                }       
            },
    "columns": [
        {data: 'concept'},
        {data: 'unity'},
        {data: 'quantity'},
        {data: 'price'},
        {data: 'extra'},
        {data: 'total'},
        {data: 'btn'}
    ],
    
    "footerCallback": function ( row, data, start, end, display ) {
        var api = this.api(), data;
    
        // Remove the formatting to get integer data for summation
        var intVal = function ( i ) {
            return typeof i === 'string' ?
                i.replace(/[\$,]/g, '')*1 :
                typeof i === 'number' ?
                    i : 0;
        };
    
        // Total over all pages
        total = api
            .column( 5 )
            .data()
            .reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );
    
        if({{$data->iva}} == 1)
        {
            $('#subtotal_iva').val(total);
            getIva();
        }
        else
            $('#total').val(total);
    
    },
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
    cleanInputs();
    
    }
    
    function cleanInputs()
    {
      $('#quantity').val(1);
      $('#extra').val(0);
      $('#total_product').val(0);
      castearInputProduct();
    }
    
    //DELETE
    $('body').delegate('.delete-product','click',function(){
            id_temporal_capture_prod = $(this).attr('id_temporalyProduct');
            var csrf_token=$('meta[name="csrf-token"]').attr('content');
            swal({
                title: "Estás seguro?",
                text: "Se eliminará el producto de la captura",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
              if (willDelete) {
                $.ajax({
                    url: "{{route('capture.deleteCaptureProduct')}}",
                    headers: {'X-CSRF-TOKEN': csrf_token},
                    type: 'DELETE',
                    dataType: 'json',
                    data: {id: id_temporal_capture_prod}
                }).done(function(data){
                  sAlert(data.title, data.text, data.icon);
                    chargeTable1();
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
    
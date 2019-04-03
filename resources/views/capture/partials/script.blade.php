<script>
$(document).ready(function () {
  castearInputProduct();
});

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
    //if(i!=0)
      price += all.charAt(i)
  }
  console.log(price);
  $('#priceCapture').val(price);

  var product_id=0;
  for (var i = price.length; i < max; i++) {
    if(all.charAt(i) == "/")
    {
      break;
    }
    //if(i!=0)
      product_id += all.charAt(i)
  }
  $('#product_id').val(product_id);

  var unity_id=0;
  for (var i = price.length+product_id.length; i < max; i++) {
    if(all.charAt(i) == "/")
    {
      break;
    }
    //if(i!=0)
      unity_id += all.charAt(i)
  }
  $('#unity_id').val(unity_id);

  var quantity = document.getElementById("quantity").value;
  var extra = document.getElementById("extra").value;
  var total = parseInt(price * quantity) + parseInt(extra);
  $('#total').val(total);
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
    var price = $('#priceCapture').val();
    var table=null;
    table = $('#products_capture_table');
    console.log(price);
    table = $('#products_capture_table').DataTable({
      "bDestroy": true,
      stateSave: true,
        "processing": true,
        "serverSide": true,
        /*"ajax": "{//{route('capture.showTablePC')}}",
        type: "post",
        data: {
            price: 1
        },*/

        "ajax": {
          type: "get",
          url: "{{route('capture.showTablePC')}}",
          data: {
              price: price
          }
        },
        "columns": [
            {data: 'unity'},
            {data: 'product_concept'},
            {data: 'price'}
        ],

  });
  cleanInputs();
});

function cleanInputs()
{
  $('#quantity').val(0);
  $('#extra').val(0);
  castearInputProduct();
}
    /*$.ajax({
      //type: "post",
      url: "{//{route('capture.showTablePC')}}",
      data: {
          price: price
      }, success: function (price) {
              alert("Se ha realizado el POST con exito "+price);
              table = $('#products_capture_table').DataTable({
                  "processing": true,
                  "serverSide": true,
                  "ajax": "{//{route('capture.showTablePC')}}",
                  "columns": [
                      {price: 'price'}
                  ],
              });
      }
    });
});*/
/*
function addProduct()
{
  console.log("HHehe");


  var table=null;
  table = $('#products_capture_table').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": "{//{route('capture.showTablePC')}}",
      "columns": [
          {data: 'id'},
          {data: 'unity'},
          {data: 'price'},
          {data: 'month'},
          {data: 'provider_id'},
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
}*/





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

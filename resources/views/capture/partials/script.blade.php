<script>
$(document).ready(function () {
  castearInputProduct();
});

function castearInputProduct()
{
  var all = document.getElementById("product").value;
  console.log(all);
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
  $('#price').val(price);

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


/*var table=null;
table = $('#products_capture_table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "{//{route('capture.showTablePC')}}",
    "columns": [
        {data: 'id'},
        {data: 'unity_id'},
        {data: 'product_id'},
        {data: 'quantity'},
        {data: 'price'},
        {data: 'extra'},
        {data: 'total'},
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
});*/

/*function addProduct()
{
  var price = $('#price').val();
  console.log(price);
}*/

$('#prod tbody').on('click','tr', function(){
var table=null;
var price =   $('#price').val();
console.log(price);
table = $('#products_capture_table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "{//{route('capture.showTablePC')}}",
    "columns": [
        {data: 'id'},
        {data: 'unity_id'},
        {data: 'product_id'},
        {data: 'quantity'},
        {data: 'price'},
        {data: 'extra'},
        {data: 'total'},
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
</script>

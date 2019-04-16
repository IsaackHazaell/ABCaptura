<script>
$(document).ready(function () {
  counter = 1;
  t = $('#products_capture_table').DataTable( {} );
  castearInputProduct();
});

function castearInputProduct()
{
  //totalFinal();
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
        table = $('#products_capture_table').DataTable({
          "bDestroy": true,
          stateSave: true,
            "processing": true,
            "serverSide": true,
            "ajax": {
              type: "get",
              url: "{{route('capture.showTablePC')}}",
              data: {
                  price: $('#product').val(),
                  capture_id: $('#capture_id').val(),
                  quantity: $('#quantity').val(),
                  extra: $('#extra').val(),
                  total: $('#total').val()
              }
            },
    "columns": [
        {data: 'unity'},
        {data: 'concept'},
        {data: 'quantity'},
        {data: 'price'},
        {data: 'extra'},
        {data: 'total'},
        {data: 'btn'}
    ],
  });
  cleanInputs();
});

function cleanInputs()
{
  var totalF = document.getElementById("total_final").value;
  var totalProducto = document.getElementById("total").value;
  var totalFinal = parseInt(totalF) + parseInt(totalProducto);
  $('#quantity').val(0);
  $('#extra').val(0);
  $('#total').val(0);
  $('#total_final').val(totalFinal);
  castearInputProduct();
}

function totalFinal()
{
  /*var total = 0;
  $('#todos').DataTable().rows().data().each(function(el, index){
    //Asumiendo que es la columna 5 de cada fila la que quieres agregar a la sumatoria
    total += el[5];
  });
  console.log(total);*/
}




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

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

      $('#total_final').val(total);
    }
  });
  cleanInputs();

});

function cleanInputs()
{
  $('#quantity').val(0);
  $('#extra').val(0);
  $('#total').val(0);
  castearInputProduct();
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

<script>
$('#product').on('change', function (event) {
  var price = document.getElementById("product").value;
  $('#price').val(price);
  var quantity = document.getElementById("quantity").value;
  var extra = document.getElementById("extra").value;
  var total = parseInt(price * quantity) + parseInt(extra);
  $('#total').val(total);
});

$('#quantity').on('change', function (event) {
  var price = document.getElementById("price").value;
  var quantity = document.getElementById("quantity").value;
  var extra = document.getElementById("extra").value;
  var total = parseInt(price * quantity) + parseInt(extra);
  $('#total').val(total);
});

$('#extra').on('change', function (event) {
  var price = document.getElementById("price").value;
  var quantity = document.getElementById("quantity").value;
  var extra = document.getElementById("extra").value;
  var total = parseInt(price * quantity) + parseInt(extra);
  $('#total').val(total);
});
</script>

<script>
//$("#formulario").on("submit", function(e){
$("#saveCapture").click(function (e) {
  if(valida())
  {
    var text = $('#fund_id').val();
    var fund_id="";
    for (var i = 0; i < text.length; i++) {
      if(text.charAt(i) == "/")
      {
        break;
      }
      //if(i!=0)
        fund_id += text.charAt(i)
    }
    var remaining = getRemaining(text);
    remaining = parseInt(remaining);
    var total = $('#total').val();
    total = parseInt(total);
    if(remaining < total)
    {
      swal({
        title: "Fondo insuficiente!",
        text: "El fondo es de $" + remaining,
        icon: "error",
        button: "Continue",
        timer: 3000
      });
    }
    else {
      $.ajax({
           type: "post",
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
           url: "{{route('capture.store')}}",
           data: {
               remaining: remaining,
               total: total,
               construction_id: $('#construction_id').val(),
               provider_id: $('#provider_id').val(),
               fund_id: fund_id,
               date: $('#date').val(),
               file: $('#file').val(),
               folio: $('#folio').val(),
               category: $('#category').val(),
               concept: $('#concept').val(),
               honorarium: $('#honorary').val(),
               iva: $('#iva').val()
           },
           success: function() {
             swal({
               title: "Capturado",
               text: "Se ha capturado correctamente",
               icon: "success",
               button: "Continue",
               timer: 3000
             });
             //window.location.reload();
            }
       });
      /*"ajax": {
        type: "post",
        url: "{//{route('capture.store')}}",
        data: {
            price: 1
        }
      },*/
    }
  }
    else {
      swal({
        title: "Error",
        text: "Datos incorrectos",
        icon: "warning",
        button: "Continue",
        timer: 3000
      });
    }
});

function valida()
{
    var x = parseFloat($('#total').val());
      if (isNaN(x))
          return false;
      else
          return true;
}

function getRemaining(text)
{
  var remaining="";
  var flag=false;
  for (var i=0; i < text.length; i++) {
    if(flag)
    {
      remaining+=text.charAt(i)
    }
    if(text.charAt(i) == "/")
    {
      flag=true;
    }
  }
  return remaining;
}
</script>

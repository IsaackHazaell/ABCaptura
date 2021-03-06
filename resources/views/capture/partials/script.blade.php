<script>
if({{$data->iva}} == 1)
{
    var total = document.getElementById("subtotal_iva");
    total.addEventListener("click", function() {
        getIva();
    });
    total.addEventListener("change", function() {
        getIva();
    })
}

$("#saveCapture").click(function (e) {
    getIva();
    //honorary_remaining

  if(valida())
  {
      var total = $('#total').val();
      total = parseFloat(total);
      provider_name = @json($provider_name);
      var category = @json($category);
      var flagForHonorary = false;
      if(provider_name == "Arq. Missael Quintero" && category == 2)
      {
          var honorary_remaining = @json($honorary_remaining);
          if(total > honorary_remaining)
              flagForHonorary = true;
      }
    var text = $('#fund_id').val();
    var fund_id="";
    for (var i = 0; i < text.length; i++) {
      if(text.charAt(i) == "/")
      {
        break;
      }
      fund_id += text.charAt(i)
    }
    var remaining = getRemaining(text);
    remaining = parseInt(remaining);
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
    else if(flagForHonorary)
    {
        swal({
          title: "Cantidad de cobro excedida",
          text: "Puede cobrar hasta $" + honorary_remaining,
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
               voucher: $('#voucher').val(),
               folio: $('#folio').val(),
               category: $('#category').val(),
               concept: $('#conceptt').val(),
               honorarium: $('#honorary').val(),
               iva: $('#iva').val(),
               temporary_capture: $('#capture_id').val()
           },
           success: function() {
             swal({
               title: "Capturado",
               text: "Se ha capturado correctamente",
               icon: "success",
               button: "Continue",
               timer: 3000
             });
             window.location.href = '{{ route('capture.index') }}';
            }
       });
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

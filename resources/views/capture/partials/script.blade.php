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
  if(valida())
  {
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
    var total = $('#total').val();
    total = parseFloat(total);
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

//EDIT
/*$('#edit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('idprovider')
    var name = button.data('nameprovider')
    var turn = button.data('turnprovider')
    var company = button.data('companyprovider')
    var category = button.data('categoryprovider')
    category = toCategory(category);
    var phone = button.data('phoneprovider')
    var phone2 = button.data('phonlandlineprovider')
    var mail = button.data('mailprovider')
    var street = button.data('streetprovider')
    var colony = button.data('colonyprovider')
    var town = button.data('townprovider')
    var state = button.data('stateprovider')
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #name').val(name);
    modal.find('.modal-body #turn').val(turn);
    modal.find('.modal-body #company').val(company);
    modal.find('.modal-body #category').val(category);
    modal.find('.modal-body #cellphone').val(phone);
    modal.find('.modal-body #phonlandline').val(phone2);
    modal.find('.modal-body #mail').val(mail);
    modal.find('.modal-body #street').val(street);
    modal.find('.modal-body #colony').val(colony);
    modal.find('.modal-body #town').val(town);
    modal.find('.modal-body #state').val(state);
});*/


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

<script>
    if({{$capture->iva}} == 1)
    {
        var total = document.getElementById("subtotal_iva");
        total.addEventListener("click", function() {
            getIva();
        });
        total.addEventListener("change", function() {
            getIva();
        });
    }

    $(document).ready(function () {
        if({{$capture->iva}} == 1)
        {
            var subtotal = getSubtotal();
             console.log(subtotal);
            $('#subtotal_iva').val(subtotal);
        }
    });

    function getSubtotal()
    {
        var total = $('#total').val();
        var subtotal = total / 1.16;
        return subtotal;
    }

    function getIva()
    {
        var iva = {{$capture->iva}};
        if(iva == 1)
        {
            var total = $('#subtotal_iva').val();
            $('#total').val(total * 1.16);
        }
    }
</script>

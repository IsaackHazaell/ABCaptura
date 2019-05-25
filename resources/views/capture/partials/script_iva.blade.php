<script>
function getIva()
{
    var iva = {{$data->iva}};
    if(iva == 1)
    {
        var total = $('#subtotal_iva').val();
        $('#total').val(total * 1.16);
    }
}
</script>

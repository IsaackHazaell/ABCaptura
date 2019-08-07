<script>
    $(document).ready(function (){
        check_rfc();
    });

    function check_rfc()
    {
        var category= $('#category').val();
        if(category == "1")
            document.getElementById('rfc_div').style.display='block';
        else
            document.getElementById('rfc_div').style.display='none';
    }
</script>
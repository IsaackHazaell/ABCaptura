<script>
    $(document).ready(function (){
        check_rfc();
    });

    function check_rfc()
    {
        var category= $('#category').val();
        var category2= $('#category2').val();
        console.log(category2);
        if(category == "1" || category2 == "Material" )
        {
            document.getElementById('rfc_div').style.display='block';
            document.getElementById('rfc_div2').style.display='block';
        }   
        else
        {
            document.getElementById('rfc_div').style.display='none';
            document.getElementById('rfc_div2').style.display='none';
        }
            
    }
</script>
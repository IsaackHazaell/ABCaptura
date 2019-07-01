<script>
$(document).ready(function () {
    changeProviders();
});

function changeProviders()
{
    var construction = $('#construction_id').val();
    var providers = "";

    var count = {{$providers->count()}};

    /*for(var i=0; i<count; i++)
    {
        providers = {{$providers}};
    }
    console.log(providers);*/
}
</script>

<script>
$(document).ready(countProducts());
function countProducts()
{
    var provider_id = document.getElementById('providers').value;
    console.log(provider_id);

    var providers = @json($providers);
    var products = @json($products);

    var counter = 0;
    products.forEach(function(product) 
    {
        if (product.provider_id == provider_id) 
        {
            counter++;
        } 
    });
    document.getElementById('count').value = counter;
    if(provider_id == "")
    {
        document.getElementById('count').value = products.length;
    }
}   
    
</script>
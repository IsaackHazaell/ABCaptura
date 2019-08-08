<script>
$(document).ready(function () {
    clearInputs();
    changeProviders();
});

function clearInputs()
{
    var cat= $('#category').val();
    if(cat == "1")
    {
        document.getElementById('div_material').style.display='block';
        document.getElementById('div_logistic').style.display='none';
    } 
    else
    {
        document.getElementById('div_material').style.display='none';
        document.getElementById('div_logistic').style.display='block';
    }
}

function changeProviders()
{
    var select_provier = document.getElementById("provider_id");
    select_provier.length = 0;
    var construction = $('#construction_id').val();
    var providers = @json($providers);

    var x = document.getElementById("provider_id");
    var counter = -1;
    providers.forEach(function(provider) {
      if (provider.construction_id == construction) {
          counter++;
          var option = document.createElement("option");
          option.text = provider.name;
          option.value = provider.provider_id;
          x.add(option, x[counter]);
      }
  });
  @if($missa != null)
      var missa = @json($missa);
      var option = document.createElement("option");
      option.text = missa.name;
      option.value = missa.id;
      counter++;
      x.add(option, x[counter]);
  @endif

  changeStatementMaterial()
}

function changeStatementMaterial()
{
    var select_statement = document.getElementById("statemnt_material_id");
    select_statement.length = 0;
    var construction = $('#construction_id').val();
    var providers_material = @json($providers_material);
    var x = document.getElementById("statemnt_material_id");
    var counter = -1;
    providers_material.forEach(function(provider) {
      if (provider.construction_id == construction) {
          counter++;
          var option = document.createElement("option");
          option.text = provider.name;
          option.value = provider.id;
          x.add(option, x[counter]);
      }
  });
}
</script>

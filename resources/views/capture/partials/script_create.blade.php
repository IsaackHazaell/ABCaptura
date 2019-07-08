<script>
$(document).ready(function () {
    changeProviders();
});

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
          option.value = provider.id;
          x.add(option, x[counter]);
      }
  });
  @if($missa != null)
      var missa = @json($missa);
      var option = document.createElement("option");
      option.text = missa.name;
      option.value = missa.id;
      x.add(option, x[counter]);
  @endif
}
</script>

<script>
    $(document).ready(function () {
        clearInputs();
    });

    function clearInputs()
    {
        var cat= $('#category').val();
        if(cat == "1")
        {
            document.getElementById('div_material').style.display='block';
            document.getElementById('lbl_provider_id').style.display='none';
            $('#name').prop("required", true);
            $('#provider_material').prop("required", true);
        } 
        else
        {
            document.getElementById('div_material').style.display='none';
            document.getElementById('lbl_provider_id').style.display='block';
            $('#name').removeAttr("required");
            $('#provider_material').removeAttr("required");
        }
    }

$("#prov").click(function (e) {
    e.preventDefault();
    chargeTable();
});

function chargeTable()
{
    table = $('#providers_material_table').DataTable({
      "bDestroy": true,
      stateSave: true,
      "ordering": false,
        "processing": true,
        "serverSide": true,
        "ajax": {
          type: "get",
          url: "{{route('statement.showTableProvMat')}}",
          data: {
              provider_id: $('#provider_material').val()
          }
        },
        "columns": [
            {data: 'name'},
            {data: 'btn'}
        ],
        "language": {
            "info": "_TOTAL_ registros",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior",
            },
            "lengthMenu": 'Mostrar <select>'+
                '<option value="10">10</option>'+
                '<option value="30">30</option>'+
                '<option value="-1">Todos</option>'+
                '</select> registros',
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "emptyTable": "No hay datos",
            "zeroRecords": "No hay coincidencias",
            "infoEmpty": "",
            "infoFiltered": ""
        }
    });
}
</script>

<script>
//DATATABLE Capture
var table=null;
table = $('#constructions_table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{route('client.showTableCC', ['client_id'=> $client->id])}}",
        "columns": [
            {data: 'construction_name'},
            {data: 'honorary'},
            {data: 'date'},
            {data: 'square_meter'},
            {data: 'status'},
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
</script>

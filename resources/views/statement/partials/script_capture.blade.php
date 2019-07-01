<script>

var table=null;
table = $('#capture_table').DataTable({
    "processing": true,
    "serverSide": true,

    "ajax": {
      type: "GET",
      url: "{{route("statement.showTableSC")}}",
      data: {
        construction_id: {{$statement->construction_id}},
        provider_id: {{ $statement->provider_id}}
      }
    },
    "columns": [
        {data: 'capture_date'},
        {data: 'capture_concept'},
        {data: 'capture_total'},
        {data: 'voucher', "className": 'text-center'},
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

</script>

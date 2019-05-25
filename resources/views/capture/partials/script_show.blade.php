<script>
var tablePCS=null;
tablePCS = $('#products_capture_show_table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "{{route('capture.showTablePCshow', ['capture_id' => $capture->id])}}",
    "columns": [
        {data: 'concept'},
        {data: 'unity'},
        {data: 'price'},
        {data: 'quantity'},
        {data: 'extra'},
        {data: 'total'}
    ],
    "language": {
      "info": "_TOTAL_ registros",
      "search": "Buscar",
      "paginate": {
        "next": "Siguinte",
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

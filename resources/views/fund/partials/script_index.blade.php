<script>
//DATATABLE Capture
var tableC=null;
var id_fund = $(this).attr('id_fund');
tableC = $('#capture_table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "{{route('fund.showTableFC', ['fund_id'=> $fund->id])}}",
    "columns": [
        {data: 'construction_name'},
        {data: 'provider_name'},
        {data: 'capture_date'},
        {data: 'capture_concept'},
        {data: 'capture_total'},
        {data: 'voucher'},
        {data: 'btn'}
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

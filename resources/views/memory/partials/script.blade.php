<script>
var table=null;
table = $('#memory_table').DataTable({
//var jobs = JSON.parse("{//{ json_encode($construction_id) }}");

    "processing": true,
    "serverSide": true,
    //"ajax": "{//{route('memory.showTableM', ['construction_id'=> $construction_id,'date'=> $date])}}",
    "ajax": {
      type: "get",
      url: "{{route('memory.showTableM')}}",
      data: {
          construction_id: "{{ $construction_id }}",
          date: "{{ $date }}"
      }
    },
    "columns": [
        {data: 'capture_date'},
        {data: 'provider_name'},
        {data: 'capture_concept'},
        {data: 'voucher'},
        {data: 'capture_total'},
        {data: 'capture_folio'}
    ],
    "footerCallback": function ( row, data, start, end, display ) {
        var api = this.api(), data;

        // Remove the formatting to get integer data for summation
        var intVal = function ( i ) {
            return typeof i === 'string' ?
                i.replace(/[\$,]/g, '')*1 :
                typeof i === 'number' ?
                    i : 0;
        };

        // Total over all pages
        total = api
            .column( 4 )
            .data()
            .reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );

      $('#total_memory').val(total);
  },



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

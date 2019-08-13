<script>
$(document).ready(function () {
    //parseFloat($('#total_without_h').val());// + parseFloat($('#total_whit_h').val());
    //alert(total_memory);

});


var table=null;
table = $('#memory_table').DataTable({
    "processing": true,
    "serverSide": true,
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
        {data: 'capture_concept'},
        {data: 'category'},
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
        total_without_h = api
            .column( 4 )
            .data()
            .reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );

      $('#total_without_h').val(total_without_h);
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


var table2=null;
table2 = $('#memory_table_honorary').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
      type: "get",
      url: "{{route('memory.showTableMH')}}",
      data: {
          construction_id: "{{ $construction_id }}",
          date: "{{ $date }}"
      }
    },
    "columns": [
        {data: 'capture_date'},
        {data: 'capture_concept'},
        {data: 'category'},
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
        total_with_h = api
            .column( 4 )
            .data()
            .reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );

      $('#total_with_h').val(total_with_h);
      getTotalMemory();
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

function getTotalMemory()
{
    var total_witho_h = parseFloat($('#total_without_h').val());
    var total_whit_hh = parseFloat($('#total_with_h').val());
    $('#total_memory').val(total_witho_h + total_whit_hh);
}
</script>

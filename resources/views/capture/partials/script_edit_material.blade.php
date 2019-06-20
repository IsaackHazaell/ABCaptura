<script>
$("#edit_products").click(function (e) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{route('capture.editProducts')}}",
            type: 'post',
            //dataType: 'json',
             data: {
                 //capture_id: $('#capture_id').val(),
                 construction_id: $('#construction_id').val(),
                 provider_id: $('#provider_id').val(),
                 fund_id:  $('#fund_id').val(),
                 date: $('#date').val(),
                 voucher: $('#voucher').val(),
                 folio: $('#folio').val(),
                 category: $('#category').val(),
                 concept: $('#concept').val(),
                 honorarium: $('#honorarium').val(),
                 iva: $('#iva').val(),
                 id: $('#id').val(),
                 voucher_prev: $('#voucher_prev').val(),
                 _token : csrf_token
             },
         }).done(function(data) {
             console.log(data[0]);

             window.location.href = '{{ view('capture.edit_products')
                 ->with('data', data[9])
                 ->with('capture_id', data[1])
                 ->with('prices', data[3])
                 ->with('funds', data[5])
             ->with('category', data[7])}}';
             //window.location.href = res.url;
             //window.location.assign(res);
        }).fail(function(xhr, a, error) {
              console.log(error);
        });
});

</script>

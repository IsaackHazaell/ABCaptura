<script>
$('#edit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('idconstruction')
    var name = button.data('nameconstruction')
    var honorary = button.data('honoraryconstruction')
    var date = button.data('dateconstruction')
    var square_meter = button.data('square_meterconstruction')
    var status = button.data('statusconstruction')

    //var data_id = button.data('iddata')
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #name').val(name);
    modal.find('.modal-body #honorary').val(honorary);
    modal.find('.modal-body #date').val(date);
    modal.find('.modal-body #square_meter').val(square_meter);
    modal.find('.modal-body #status').val(status);
    //modal.find('.modal-body #data_id').val(data_id);
});

</script>

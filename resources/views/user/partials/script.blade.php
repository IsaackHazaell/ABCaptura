<script>
//DATATABLE
var table=null;
table = $('#users_table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "{{route('user.showTableU')}}",
    "columns": [
        {data: 'name'},
        {data: 'email'},
        {data: 'user_type'},
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

// $(document).ready(function(){
//
//   var id = $(this).attr('id_user');
//   var log_id = {{Auth::user()->id}} ;
//     console.log(id);
//
// });

//EDIT
$('#edit').on('show.bs.modal', function (event) {
  var log_id = {{Auth::user()->id}} ;
    var button = $(event.relatedTarget)
    var id = button.data('iduser')
    var name = button.data('name')
    var email = button.data('email')
    var password = button.data('password')
    var user_type = button.data('user_type')
    var modal = $(this)

    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #name').val(name);
    modal.find('.modal-body #email').val(email);
    if(log_id == id){
      document.getElementById("password").readOnly = false;
          modal.find('.modal-body #password').val(password);
    }else {
      document.getElementById("password").readOnly = true;
      modal.find('.modal-body #password').val(password);
    }

    modal.find('.modal-body #user_type').val(user_type);
});


//DELETE
$('body').delegate('.status-user','click',function(){
        id_user = $(this).attr('id_user');
        var csrf_token=$('meta[name="csrf-token"]').attr('content');
        swal({
            title: "Estás seguro?",
            text: "Se eliminará el usuario",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            $.ajax({
                url: "{{url('/user')}}" + '/' + id_user,
                headers: {'X-CSRF-TOKEN': csrf_token},
                type: 'DELETE',
                dataType: 'json',
                data: {id: id_user}
            }).done(function(data){
              table.ajax.reload();
              sAlert(data.title, data.text, data.icon);
            });
          }
        });
    });


//SWETALERT
@if (Session::has('message'))
        sAlert(
        "{{ Session::get('message.title') }}",
        "{{ Session::get('message.text') }}",
        "{{ Session::get('message.icon') }}"
    );
@endif

function sAlert(title, text, icon)
{
  swal({
    title: title,
    text: text,
    icon: icon,
    button: "Continue",
    timer: 3000
  });
}
</script>

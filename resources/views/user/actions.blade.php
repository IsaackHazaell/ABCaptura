<button class="btn btn-primary btn-sm"
  data-iduser="{{$id}}"
  data-name="{{$name}}"
  data-email="{{$email}}"
  data-password="{{$password}}"
  data-user_type="{{$user_type}}"

  data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>

  <a id_user="{{ $id }}" class="btn btn-danger btn-sm status-user">
      <span class="fa fa-trash"></span>
  </a>

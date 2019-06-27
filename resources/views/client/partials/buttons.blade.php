<a href="{{ route('client.show', $id) }}" class="btn btn-info btn-sm">
  <i class="fa fa-eye"></i></a>

<button class="btn btn-primary btn-sm"
  data-idclient="{{$id}}"
  data-nameclient="{{$name}}"
  data-phoneclient="{{$cellphone}}"
  data-phonelandlineclient="{{$phonelandline}}"
  data-emailclient="{{$email}}"
  data-addressclient="{{$address}}"
  data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>

  <a id_client="{{ $id }}" class="btn btn-danger btn-sm delete" client_name="{{ $name }}">
      <span class="fa fa-trash"></span>
  </a>

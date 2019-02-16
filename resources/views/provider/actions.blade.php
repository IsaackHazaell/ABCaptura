<a href="{{ route('provider.show', $id) }}" class="btn btn-info btn-sm">
  <i class="fa fa-eye"></i></a>

<button class="btn btn-primary btn-sm"
  data-idclient="{{$id}}"
  data-nameclient="{{$name}}"
  data-phone1client="{{$phone}}"
  data-emailclient="{{$mail}}"
  data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>

<a class="btn btn-danger btn-sm" onclick="add( {{ $id }} );" data-id="{{$id}}">
  <i class="fa fa-trash"></i></a>

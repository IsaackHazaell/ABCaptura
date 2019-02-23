<a href="{{ route('provider.show', $id) }}" class="btn btn-info btn-sm">
  <i class="fa fa-eye"></i></a>

<button class="btn btn-primary btn-sm"
  data-idprovider="{{$id}}"
  data-nameprovider="{{$name}}"
  data-turnprovider="{{$turn}}"
  data-phoneprovider="{{$phone}}"
  data-mailprovider="{{$mail}}"

  data-streetprovider="{{$street}}"
  data-colonyprovider="{{$colony}}"
  data-townprovider="{{$town}}"
  data-stateprovider="{{$state}}"
  data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>

<a class="btn btn-danger btn-sm" onclick="delete( {{ $id }} );" data-id="{{$id}}">
  <i class="fa fa-trash"></i></a>

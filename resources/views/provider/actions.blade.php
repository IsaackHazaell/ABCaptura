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

  <a id_provider="{{ $id }}" class="btn btn-danger btn-sm status-provider" provider_name="{{ $name }}">
      <span class="fa fa-trash"></span>
  </a>

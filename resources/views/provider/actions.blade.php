<a href="{{ route('provider.show', $provider_id) }}" class="btn btn-info btn-sm">
  <i class="fa fa-eye"></i></a>

<button class="btn btn-primary btn-sm"
  data-idprovider="{{$provider_id}}"
  data-nameprovider="{{$name}}"
  data-turnprovider="{{$turn}}"
  data-categoryprovider="{{$category}}"
  data-companyprovider="{{$company}}"
  data-phoneprovider="{{$cellphone}}"
  data-phonlandlineprovider="{{$phonlandline}}"
  data-mailprovider="{{$mail}}"
  data-rfcprovider="{{$rfc}}"
  data-streetprovider="{{$street}}"
  data-colonyprovider="{{$colony}}"
  data-townprovider="{{$town}}"
  data-stateprovider="{{$state}}"
  data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>

  <a id_provider="{{ $provider_id }}" class="btn btn-danger btn-sm status-provider" provider_name="{{ $name }}">
      <span class="fa fa-trash"></span>
  </a>

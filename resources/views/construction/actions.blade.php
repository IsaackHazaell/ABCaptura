<a href="{{route('construction.show', $construction_id) }}" class="btn btn-info btn-sm">
  <i class="fa fa-eye"></i></a>

<button class="btn btn-primary btn-sm"
  data-idconstruction="{{$construction_id}}"
  data-nameconstruction="{{$construction_name}}"
  data-honoraryconstruction="{{$honorary}}"
  data-dateconstruction="{{$date}}"
  data-square_meterconstruction="{{$square_meter}}"
  data-statusconstruction="{{$status}}"

  data-client_name="{{$client_name}}"
  data-cellphone="{{$cellphone}}"
  data-phonelandline="{{$phonelandline}}"
  data-address="{{$address}}"
  data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>

  <a id_construction="{{ $construction_id }}" class="btn btn-danger btn-sm status-construction" construction_name="{{ $construction_name }}">
      <span class="fa fa-trash"></span>
  </a>

<a href="{{route('construction.show', $construction_id) }}" class="btn btn-info btn-sm">
  <i class="fa fa-eye"></i></a>

<button class="btn btn-primary btn-sm"
  data-idconstruction="{{$construction_id}}"
  data-nameconstruction="{{$construction_name}}"
  data-honoraryconstruction="{{$honorary}}"
  data-dateconstruction="{{ \Carbon\Carbon::parse($date)->format('Y-m-d')}}"
  data-square_meterconstruction="{{ floatval(str_replace(",","",$square_meter))}}"
  data-statusconstruction="{{$construction_status}}"
  data-client_id="{{$client_id}}"
  data-client_name="{{$client_name}}"
  data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>

  <a id_construction="{{ $construction_id }}" class="btn btn-danger btn-sm status-construction" construction_name="{{ $construction_name }}">
      <span class="fa fa-trash"></span>
  </a>

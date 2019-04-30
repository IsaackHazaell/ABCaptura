<a href="{{route('statement.show', $statement_id) }}" class="btn btn-info btn-sm">
  <i class="fa fa-eye"></i></a>

<button class="btn btn-primary btn-sm"
  data-idstatement="{{$statement_id}}"
  data-namestatement="{{$statement_name}}"
  data-honorarystatement="{{$honorary}}"
  data-datestatement="{{$date}}"
  data-square_meterstatement="{{$square_meter}}"
  data-statusstatement="{{$status}}"

  data-client_name="{{$client_name}}"
  data-cellphone="{{$cellphone}}"
  data-phonelandline="{{$phonelandline}}"
  data-address="{{$address}}"
  data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>

  <a id_statement="{{ $statement_id }}" class="btn btn-danger btn-sm status-statement" statement_name="{{ $statement_name }}">
      <span class="fa fa-trash"></span>
  </a>

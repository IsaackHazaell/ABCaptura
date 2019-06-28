<a href="{{route('statement.show', $statement_id) }}" class="btn btn-info btn-sm">
  <i class="fa fa-eye"></i></a>

<button class="btn btn-primary btn-sm"
  data-idstatement="{{$statement_id}}"
  data-nameconstruction="{{$construction_name}}"
  data-nameprovider="{{$provider_name}}"
  data-statusstatement="{{$status}}"
  data-remainingstatement="{{intval(str_replace(",","",$remaining))}}"
  data-totalstatement="{{intval(str_replace(",","",$total))}}"

  data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>

  <a id_statement="{{ $statement_id }}" class="btn btn-danger btn-sm status-statement">
      <span class="fa fa-trash"></span>
  </a>

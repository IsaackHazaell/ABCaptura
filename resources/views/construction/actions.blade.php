<a href="{{route('construction.show', $id) }}" class="btn btn-info btn-sm">
  <i class="fa fa-eye"></i></a>

<button class="btn btn-primary btn-sm"
  data-idconstruction="{{$id}}"
  data-nameconstruction="{{$name}}"
  data-statusconstruction="{{$status}}"
  data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>
<a href="{{route('fund.show', $id) }}" class="btn btn-info btn-sm">
  <i class="fa fa-eye"></i></a>

<button class="btn btn-primary btn-sm"
  data-idfund="{{$id}}"
  data-construction_id="{{$construction_id}}"
  data-total="{{$total}}"
  data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>

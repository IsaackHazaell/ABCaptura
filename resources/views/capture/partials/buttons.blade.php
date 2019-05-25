<a href="{{ route('capture.show', $capture_id) }}" class="btn btn-info btn-sm">
  <i class="fa fa-eye"></i></a>

<button class="btn btn-primary btn-sm"
    data-idcapture="{{$capture_id}}"
data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>

<a id_capture="{{ $capture_id }}" class="btn btn-danger btn-sm delete-capture">
    <span class="fa fa-trash"></span>
</a>

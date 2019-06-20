<a href="{{ route('capture.show', $capture_id) }}" class="btn btn-info btn-sm">
  <i class="fa fa-eye"></i></a>

<a href="{{ route('capture.edit', $capture_id) }}" class="btn btn-primary btn-sm">
    <i class="fa fa-edit"></i></a>

<a id_capture="{{ $capture_id }}" class="btn btn-danger btn-sm delete-capture">
    <span class="fa fa-trash"></span>
</a>

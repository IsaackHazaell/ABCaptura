<a href="{{ route('unity.show', $id) }}" class="btn btn-info btn-sm">
  <i class="fa fa-eye"></i></a>

<button class="btn btn-primary btn-sm"
  data-idunity="{{$id}}"
  data-nameunity="{{$name}}"
  data-turnunity="{{$reference}}"
  data-phoneunity="{{$equivalent}}"
  data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>

  <a id_unity="{{ $id }}" class="btn btn-danger btn-sm status-unity" unity_name="{{ $name }}">
      <span class="fa fa-trash"></span>
  </a>

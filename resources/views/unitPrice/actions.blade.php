<a href="{{ route('provider.show', $id) }}" class="btn btn-info btn-sm">
  <i class="fa fa-eye"></i></a>

<button class="btn btn-primary btn-sm"
  data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>

<a id_customer="{{ $id }}" class="btn btn-danger btn-sm status-customer" customer_name="{{ $name }}">
    <span class="fa fa-trash"></span>
</a>

<button class="btn btn-primary btn-sm"
  data-idproduct="{{$id}}"
  data-nameproduct="{{$concept}}"
  data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>

  <a id_product="{{ $id }}" class="btn btn-danger btn-sm status-product" product_name="{{ $concept }}">
      <span class="fa fa-trash"></span>
  </a>

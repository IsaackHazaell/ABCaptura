<button class="btn btn-primary btn-sm"
  data-id="{{$id}}"
  data-providerid="{{$provider_id}}"
  data-conceptproduct="{{$concept}}"
  data-descriptionproduct="{{$description}}"
  data-unity="{{$unity}}"
  data-price="{{$price}}"
  data-year="{{$year}}"
  data-month="{{$month}}"
  data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>

  <a id_product="{{ $id }}" class="btn btn-danger btn-sm status-product" product_name="{{ $concept }}">
      <span class="fa fa-trash"></span>
  </a>

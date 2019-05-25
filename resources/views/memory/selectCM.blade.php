@extends('admin.layout')
@section('content')

<section class="content-header">
  <h1>
    Memoria
  </h1>
</section>

<form action="{{route('memory.viewClient')}}" >
  {{csrf_field()}}
  <br>
  <div class="form-row">
      <div class="form-group col-md-6">
        <label for="construction_id">Seleccione la obra</label>
        <select class="form-control" required name="construction_id" id="construction_id">
          @foreach($constructions as $construction)
          <option value="{{$construction->id}}">{{$construction->name}}</option>
          @endforeach
      </select>
      </div>
  </div>
    <div class="form-row">
      <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary">Continuar</button>
      </div>
    </div>
</form>
@endsection

@section('adminlte_js')

@stop

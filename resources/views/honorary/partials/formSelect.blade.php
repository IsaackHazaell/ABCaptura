<div class="form-row">
    <div class="form-group col-md-6">
      <label for="construction_id">Seleccione la obra</label>
      <select class="form-control" required name="construction_id" id="construction_id">
        @foreach($constructions as $construction)
        <option>{{$construction->id}} {{$construction->name}}</option>
        @endforeach
    </select>
    </div>
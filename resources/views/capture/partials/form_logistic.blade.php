<div class="form-row">
    <div class="form-group col-md-6">
        <label for="fund_id">Fondo</label>
        <select class="form-control" required name="fund_id" id="fund_id">
            @foreach($funds as $fund)
                <option value={{$fund->id}}/{{$fund->remaining}}>{{$fund->id}} {{$fund->name}} - {{$fund->date}}</option>
            @endforeach
        </select>
    </div>

</div>

@include('capture.partials.iva')

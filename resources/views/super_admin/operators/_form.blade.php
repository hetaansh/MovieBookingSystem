<div class="card-body">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Name" value="{{ old('name', isset($operator) ? $operator->name : "") }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="state_id" class="col-sm-2 col-form-label">City</label>
        <div class="col-sm-10">
            <x-adminlte-select2 name="city_id" id="city_id">
                <option value=""> -- Select One --</option>
                @foreach ($cities as $city)
                <option value="{{$city->id}}" {{ isset($operator) ? 'disabled' : "" }}  {{ (old('city_id') == $city->id || isset($operator) && $operator->city_id == $city->id) ? "selected" : "" }}>{{ $city->name }}</option>
                @endforeach
            </x-adminlte-select2>
        </div>
    </div>
</div>

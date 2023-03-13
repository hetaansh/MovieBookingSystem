<div class="card-body">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Name" value="{{ old('name', isset($city) ? $city->name : "") }}">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="state_id" class="col-sm-2 col-form-label">State</label>
        <div class="col-sm-10">
            <x-adminlte-select2 name="state_id" id="state_id" >
                <option value=""> -- Select One --</option>
                @foreach ($states as $state)
                <option value="{{$state->id}}" {{ isset($city) ? 'disabled' : "" }} {{ (old('state_id') == $state->id || isset($city) && $city->state_id == $state->id) ? "selected" : "" }} >{{ $state->name }}</option>
                @endforeach
            </x-adminlte-select2>
        </div>
    </div>

</div>
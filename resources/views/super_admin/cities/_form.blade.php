<div class="card-body">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Name" value="{{ old('name', isset($city) ? $city->name : "") }}" required data-rule-maxlength='50'>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="state_id" class="col-sm-2 col-form-label">State</label>
        <div class="col-sm-10">
            <x-adminlte-select2 name="state_id" id="state_id" required :config="['disabled'=> isset($city) ? true : false]">
                <x-adminlte-options 
                :options="$states" 
                :selected="(isset($city)? $city->state_id : null)"
                placeholder="-- Select State --" />
            </x-adminlte-select2>
        </div>
    </div>

</div>
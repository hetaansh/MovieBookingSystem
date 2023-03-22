<div class="card-body">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Cinema" value="{{ old('name', isset($cinema) ? $cinema->name : "") }}" required data-rule-maxlength='50'>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="city_id" class="col-sm-2 col-form-label">City</label>
        <div class="col-sm-10">
            <x-adminlte-select2 name="city_id" id="city_id" required :config="['disabled'=> isset($cinema) ? true : false]">
                <x-adminlte-options 
                :options="$cities" 
                :selected="(isset($cinema)? $cinema->city_id : null)"
                placeholder="-- Select City --" />
            </x-adminlte-select2>
        </div>
    </div>
    <div class="form-group row">
        <label for="address" class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-10">
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Enter Address" value="{{ old('address', isset($cinema) ? $cinema->address : "") }}" required data-rule-maxlength='255'>
            @error('address')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="pincode" class="col-sm-2 col-form-label">Pincode</label>
        <div class="col-sm-10">
            <input type="number" class="form-control @error('pincode') is-invalid @enderror" id="pincode" name="pincode" placeholder="Enter Pincode" value="{{ old('pincode', isset($cinema) ? $cinema->pincode : "") }}" required data-rule-maxlength='15'>
            @error('pincode')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

</div>
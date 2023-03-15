<div class="card-body">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Name" value="{{ old('name', isset($operator) ? $operator->name : "") }}" required data-rule-maxlength='50'>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="city_id" class="col-sm-2 col-form-label">City</label>
        <div class="col-sm-10">
            <x-adminlte-select2 name="city_id" id="city_id" required :config="['disabled'=> isset($operator) ? true : false]">
                <x-adminlte-options 
                :options="$cities" 
                :selected="(isset($operator) ? $operator->city_id : null)" 
                placeholder="-- Select City --" />
            </x-adminlte-select2>
        </div>
    </div>


</div>


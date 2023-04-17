<div class="card-body">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Screen Name" value="{{ old('name', isset($screen) ? $screen->name : "") }}" required data-rule-maxlength='50'>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="cinema_id" class="col-sm-2 col-form-label">Cinema</label>
        <div class="col-sm-10">
            <x-adminlte-select2 name="cinema_id" id="cinema_id" required :config="['disabled'=> isset($screen) ? true : false]">
                <x-adminlte-options
                :options="$cinemas"
                :selected="(isset($screen)? $screen->cinema_id : null)"
                placeholder="-- Select Cinema --" />
            </x-adminlte-select2>
        </div>
    </div>

    <div class="form-group row">
        <label for="rows" class="col-sm-2 col-form-label">Rows</label>
        <div class="col-sm-10">
            <input type="number" class="form-control @error('rows') is-invalid @enderror" id="rows" name="rows" placeholder="Enter Rows" value="{{ old('rows', isset($screen) ? $screen->rows : "") }}" {{ isset($screen) ? 'disabled' : '' }} required data-rule-maxlength='2'>
            @error('rows')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="cols" class="col-sm-2 col-form-label">Columns</label>
        <div class="col-sm-10">
            <input type="number" class="form-control @error('cols') is-invalid @enderror" id="cols" name="cols" placeholder="Enter Columns" value="{{ old('cols', isset($screen) ? $screen->cols : "") }}" {{ isset($screen) ? 'disabled' : '' }} required data-rule-maxlength='2'>
            @error('cols')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>


</div>

<div class="card-body">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Name" value="{{ old('name', isset($state) ? $state->name : "") }}" required data-rule-maxlength='50'>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

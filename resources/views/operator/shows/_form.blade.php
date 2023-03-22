
<div class="card-body">

    <div class="form-group row">
        <label for="cinema_id" class="col-sm-2 col-form-label">Cinema</label>
        <div class="col-sm-10">
            <x-adminlte-select2 name="cinema_id" id="cinema_id" required :config="['disabled'=> isset($show) ? true : false]">
                <x-adminlte-options :options="$cinemas"  placeholder="-- Select Cinema --" />
            </x-adminlte-select2>
        </div>
    </div>
    <div class="form-group row">
        <label for="screen_id" class="col-sm-2 col-form-label">Screens</label>
        <div class="col-sm-10">
            <x-adminlte-select2 name="screen_id" id="screen_id" required :config="['disabled'=> isset($show) ? true : false]">
                <x-adminlte-options :options=" :selected="(isset($show)? $show->screen_id : null)" placeholder="-- Select Screen --" />
            </x-adminlte-select2>
        </div>
    </div>
    <div class="form-group row">
        <label for="movie_id" class="col-sm-2 col-form-label">Movies</label>
        <div class="col-sm-10">
            <x-adminlte-select2 name="movie_id" id="movie_id" required :config="['disabled'=> isset($show) ? true : false]">
                <x-adminlte-options :options="$movies" :selected="(isset($show)? $show->movie_id : null)" placeholder="-- Select Movie --" />
            </x-adminlte-select2>
        </div>
    </div>

    <div class="form-group row">
        <label for="duration" class="col-sm-2 col-form-label">Movie Duration</label>
        <div class="col-sm-10">
            <input type="text" class="form-control @error('duration') is-invalid @enderror" id="duration" name="duration" placeholder="Enter Duration" disabled required data-rule-maxlength='4'>
            @error('duration')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="release_at" class="col-sm-2 col-form-label">Movie Release Date</label>
        <div class="col-sm-10">
            <input type="text" class="form-control @error('release_at') is-invalid @enderror" id="release_at" name="release_at" placeholder="Enter Release Date" disabled  required data-rule-maxlength='4'>
            @error('release_at')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="price" class="col-sm-2 col-form-label">Price</label>
        <div class="col-sm-10">
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Enter Price" value="{{ old('price', isset($show) ? $show->price : "") }}" required data-rule-maxlength='4'>
            @error('price')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="start_at" class="col-sm-2 col-form-label">Start At</label>
        <div class="col-sm-10">
            <div class="input-group date" id="start_at" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" id="start_at" name="start_at" data-target="#start_at" placeholder="Enter Start Date and Time" value="{{ old('start_at', isset($show) ? $show->start_at : "") }}">
                <div class="input-group-append" data-target="#start_at" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
                @error('start_at')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="end_at" class="col-sm-2 col-form-label">End At</label>
        <div class="col-sm-10">
            <div class="input-group date" id="end_at" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input" id="end_at" name="end_at" data-target="#end_at" placeholder="Enter End Date and Time" value="{{ old('end_at', isset($show) ? $show->end_at : "") }}">
                <div class="input-group-append" data-target="#end_at" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
                @error('end_at')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>


</div>
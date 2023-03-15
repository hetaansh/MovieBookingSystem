<div class="card-body">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Name" value="{{ old('name', isset($movie) ? $movie->name : "") }}" required data-rule-maxlength='50'>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="description" class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10">
            <input type="text"  class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Enter Description" value="{{ old('description', isset($movie) ? $movie->description : "") }}" required data-rule-maxlength='255'>
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="duration" class="col-sm-2 col-form-label">Duration</label>
        <div class="col-sm-10">
            <input type="name" class="form-control @error('duration') is-invalid @enderror" id="duration" name="duration" placeholder="Enter Duration" value="{{ old('duration', isset($movie) ? $movie->duration : "") }}" required data-rule-maxlength='50'>
            @error('duration')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="director" class="col-sm-2 col-form-label">Director Name</label>
        <div class="col-sm-10">
            <input type="name" class="form-control @error('director') is-invalid @enderror" id="director" name="director" placeholder="Enter Director Name" value="{{ old('director', isset($movie) ? $movie->director : "") }}" required data-rule-maxlength='50'>
            @error('director')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="movie_cast" class="col-sm-2 col-form-label">Movie Cast</label>
        <div class="col-sm-10">
            <input type="name" class="form-control @error('movie_cast') is-invalid @enderror" id="movie_cast" name="movie_cast" placeholder="Enter Cast Name" value="{{ old('movie_cast', isset($movie) ? $movie->movie_cast : "") }}" required data-rule-maxlength='255'>
            @error('movie_cast')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

</div>


<div class="card-body">
    <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Name"  value="{{ old('name', isset($data) ? $data->name : "") }}" required data-rule-maxlength='50'>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter Email"  value="{{ old('email', isset($data) ? $data->email : "") }}" required data-rule-maxlength='50'>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="image" class="col-sm-2 col-form-label">Profile Picture</label>
        <div class="col-sm-10">
            <img src="{{ asset('profile/images/'. Auth::user()->image) }}" class="w-25" alt="">
        </div>
    </div>

    <div class="form-group row">
        <label for="image" class="col-sm-2 col-form-label">Change Profile Picture</label>
        <div class="col-sm-10">
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" placeholder="Select Image" >
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>




</div>          
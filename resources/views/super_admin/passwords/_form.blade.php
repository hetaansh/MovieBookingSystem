<div class="card-body">

<div class="form-group row">
<label for="password" class="col-sm-2 col-form-label">New Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter Password"  autocomplete="current-password" required data-rule-maxlength='50'>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">Confirm Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"" id=" password_confirmation" name="password_confirmation" placeholder="Enter Confirm Password"  autocomplete="current-password" required data-rule-maxlength='50' data-rule-equal='#password'> 
        </div>
    </div>




</div>          
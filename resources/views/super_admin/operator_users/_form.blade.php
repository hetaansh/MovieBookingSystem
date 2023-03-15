<div class="card-body">
    <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Name"  value="{{ old('name', isset($operator_user) ? $operator_user->name : "") }}" required data-rule-maxlength='50'>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="operator_id" class="col-sm-2 col-form-label">Operator</label>
        <div class="col-sm-10">
<x-adminlte-select2 name="operator_id" id="operator_id" required :config="['disabled'=> isset($operator_user) ? true : false]">
                <x-adminlte-options 
                :options="$operators" 
                :selected="(isset($operator_user)? $operator_user->operator_id : null)"
                placeholder="-- Select Operator --" />
            </x-adminlte-select2>
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter Email"  value="{{ old('email', isset($operator_user) ? $operator_user->email : "") }}" required data-rule-maxlength='50'>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter Password"  autocomplete="current-password"   data-rule-minlength='8'>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">Confirm Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"" id=" password_confirmation" name="password_confirmation" placeholder="Enter Confirm Password"  autocomplete="current-password"  data-rule-minlength='8'> 
        </div>
    </div>

</div>          
<div class="card-body">
    <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Name"  value="{{ old('name', isset($operator_user) ? $operator_user->name : "") }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="state_id" class="col-sm-2 col-form-label">Operator</label>
        <div class="col-sm-10">
                <x-adminlte-select2 name="operator_id" id="operator_id">
                <option value=""> -- Select One --</option>
                @foreach ($operators as $operator)
                <option value="{{$operator->id}}" {{ isset($operator_user) ? 'disabled' : "" }} {{ (old('operator_id') == $operator->id || isset($operator_user) && $operator_user->operator_id == $operator->id) ? "selected" : "" }}>{{ $operator->name }}</option>
                @endforeach
            </x-adminlte-select2>
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter Email"  value="{{ old('email', isset($operator_user) ? $operator_user->email : "") }}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter Password"  autocomplete="current-password">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">Confirm Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"" id=" password_confirmation" name="password_confirmation" placeholder="Enter Confirm Password"  autocomplete="current-password"> 
        </div>
    </div>

</div>          
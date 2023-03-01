@if(Request::is('*/create'))
<form action="{{ route('operatorUsers.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
    <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required>
        </div>
        <div class="form-group">
            <label for="name">Operator ID</label>
            <input type="text" class="form-control" name="operator_id" id="operator_id" placeholder="Enter Operator ID" required>
        </div>
        <div class="form-group">
            <label for="name">Email</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" required>
        </div>
        {{-- Password field --}}
        <div class="form-group">
        <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="{{ __('adminlte::adminlte.password') }}">


            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Confirm password field --}}
        <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
            <input type="password" name="password_confirmation"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   placeholder="{{ __('adminlte::adminlte.retype_password') }}">

            
            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" required>
            <label class="form-check-label" for="checkout">Check me out</label>
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endif
@if(Request::is('*/edit'))
<form action="{{ route('operatorUsers.update', $data->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card-body">
    <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" value="{{ $data->name }}" name="name" id="name" placeholder="Enter Name" required>
        </div>
        <div class="form-group">
            <label for="name">Operator ID</label>
            <input type="text" class="form-control" value="{{ $data->operator_id }}" name="operator_id" id="operator_id" placeholder="Enter Operator ID" required>
        </div>
        <div class="form-group">
            <label for="name">Email</label>
            <input type="text" class="form-control" value="{{ $data->email }}" name="email" id="email" placeholder="Enter Email" required>
        </div>
        {{-- Password field --}}
        <div class="form-group">
        <label for="password">Password</label>
            <input type="password" id="password" value="{{ $data->password}}" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="{{ __('adminlte::adminlte.password') }}">


            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Confirm password field --}}
        <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
            <input type="password" name="password_confirmation" value="{{ $data->password}}"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   placeholder="{{ __('adminlte::adminlte.retype_password') }}">

            
            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" required>
            <label class="form-check-label" for="checkout">Check me out</label>
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endif
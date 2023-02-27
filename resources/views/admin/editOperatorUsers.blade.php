@extends('adminlte::page')

@section('title', 'Update Operators')




@section('content')
<form action="{{ route('admin.operatorUsers.edit') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <input type="hidden" name="id" value="{{ $data -> id }}" >
    <div class="form-group">
            <label for="name">Name</label>
            <input type="text" value="{{ $data->name }}" class="form-control" name="name" id="name" placeholder="Enter Name" required>
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" value="{{ $data->email }}" class="form-control" name="email" id="email" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label for="name">City</label>
            <input type="text" value="{{ $data->city }}" class="form-control" name="city" id="city" placeholder="Enter City" required>
        </div>
        <div class="form-group">
            <label for="name">Operator</label>
            <input type="text" value="{{ $data->operator }}" class="form-control" name="operator" id="operator" placeholder="Enter Operator" required>
        </div>

        {{-- Password field --}}
        <div class="form-group">
        <label for="password">Password</label>
            <input type="password"  value="{{ $data->password }}" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
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
            <input type="password" value="{{ $data->password }}" name="password_confirmation"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   placeholder="{{ __('adminlte::adminlte.retype_password') }}">

            
            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label>File input</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="operator_dp" >
                    <label class="custom-file-label" for="operator_dp">Choose file</label>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text">Upload</span>
                </div>
            </div>
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

@stop
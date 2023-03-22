@extends('adminlte::page')

@section('title', 'Profile')

@section('content')

<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>


<body>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('operator/profile/' . Auth::id(). '/edit') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Update Profile</h3>
        </div>

        <form class="form-horizontal" data-validate="true" novalidate action="{{ route('profile.update', Auth::id()) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('operator.profile._form')

            <div class="card-footer">
                <button type="submit" id="sub" class="btn btn-primary">Submit</button>
                <button type="submit" class="btn btn-default float-right"><a href="{{ url('operator/dashboard') }}">Cancel</a></button>
            </div>

        </form>


</body>

<script>
    @if(Session::has('message'))
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "tapToDismiss": true,
        "fadeOut": 5000,
    }
    toastr.success("{{ session('message') }}");
    @endif
    @if(Session::has('fail-message'))
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "tapToDismiss": true,
        "fadeOut": 5000,
    }
    toastr.error("{{ session('fail-message') }}");
    @endif
</script>


@stop

@section('css')



@stop

@section('js')
@include('super_admin.__jquery_validations')
@stop
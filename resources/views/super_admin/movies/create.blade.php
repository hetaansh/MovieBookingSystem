@extends('adminlte::page')

@section('title', 'Add Movie')




@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" />


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('operators.create') }}">Add</a></li>
                    <li class="breadcrumb-item active"><a style="color:#6c757d" href="{{ route('movies.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div>
        </div>
    </div>
</section>


<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Add Movie</h3>
    </div>



    <form class="form-horizontal" data-validate="true" novalidate action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('super_admin.movies._form')
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-default float-right" href="{{route('movies.index')}}">Cancel</a>
        </div>

    </form>
</div>





@stop

@section('js')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous"></script>

@include('super_admin.__jquery_validations')

<script>
    $(document).ready(function() {
        $('#release_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            stepping: 15
        });
    });
</script>
@stop
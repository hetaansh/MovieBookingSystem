@extends('adminlte::page')

@section('title', 'Update Show')




@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" />

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('shows.index') }}">{{ $title }}</a></li>
                    <li class="breadcrumb-item active"><a>Edit</a></li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Edit Show</h3>
    </div>
    <form class="form-horizontal" data-validate="true" novalidate action="{{ route('shows.update', $show->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('operator.shows._form')

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-default float-right" href="{{route('shows.index')}}">Cancel</a>
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
        // $('#cinema_id').change(function() {
        //     let cinema_id = $(this).val();
        //     if (cinema_id != '') {
        //         $.ajax({
        //             url: 'getScreen',
        //             type: 'post',
        //             data: 'cinema_id=' + cinema_id + '&_token={{csrf_token()}}',
        //             success: function(result) {
        //                 $('#screen_id').html('<option value="">-- Select Screen --</option>');
        //                 $.each(result, function(key, value) {
        //                     $("#screen_id").append('<option value="' + value
        //                         .id + '">' + value.name + '</option>');
        //                 });

        //             }
        //         });
        //     } else {
        //         $('#screen_id').html('<option value="">-- Select Cinema --</option>');
        //     }
        // });

        $('#movie_id').change(function() {
            let movie_id = $(this).val();

            if (movie_id != '') {
                $.ajax({
                    url: 'getMovie',
                    type: 'post',
                    data: 'movie_id=' + movie_id + '&_token={{csrf_token()}}',
                    success: function(result) {
                        $('#duration').val(result.duration);
                        $('#release_at').val(result.release_at);

                    }
                });
            }
        });
        let release_date = $('#release_at').val();



        $('#start_at').on('change.datetimepicker', function(e) {
            $('#end_at').datetimepicker('date', moment(e.date).add($('#duration').val(), 'minutes'));
        });

        $('#cinema_id').change();

        $('#end_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            stepping: 15
        });
        $('#start_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            stepping: 15,
        });

        $('#start_at').datetimepicker('minDate', moment(release_date));

    });

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
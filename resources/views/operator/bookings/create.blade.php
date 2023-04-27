@extends('adminlte::page')

@section('title', 'Seats')

@section('content')

    <head>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('operator.bookings.style')
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
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('bookings.index') }}">{{ $title }}</a></li>
                        <li class="breadcrumb-item active"><a>Add</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="color: white;
                                background-color: #17a2b8 ;
                                border-bottom: 1px solid rgba(0,0,0,.125);
                                padding: .75rem 1.25rem;
                                position: relative;
                                border-top-left-radius: .25rem;
                                border-top-right-radius: .25rem;">
                            <h3 class=" card-title
                            ">Add Booking</h3>
                        </div>
                        <div class="card-body">

                            @include('operator.bookings.form')

                        </div>
                    </div>
                    @include('operator.bookings.seat-menu')
                </div>
            </div>
        </div>
    </section>
    </body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @include('operator.bookings.jquery')

@stop

@section('css')

    <link href="{{ asset('/datatable/css/dataTables.bulma.min.css') }}" rel="stylesheet">

    <link href="{{ asset('/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">

@stop

@section('js')
    <script src="//cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
@stop

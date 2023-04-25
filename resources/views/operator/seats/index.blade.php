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


        @include('operator.seats.style')

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
                        <li class="breadcrumb-item active">{{ $title }}</li>
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
                        <div class="card-body">

                            <form action="{{ route('bookings.store') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name" placeholder="Enter Name"
                                               required
                                               data-rule-maxlength='50'>
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="cinema_id" class="col-sm-2 col-form-label">Cinema</label>
                                    <div class="col-sm-10">
                                        <x-adminlte-select2 name="cinema_id" id="cinema_id" required
                                                            :config="['disabled'=> isset($show) ? true : false]">
                                            <x-adminlte-options :options="$cinemas"
                                                                placeholder="-- Select Cinema --"/>
                                        </x-adminlte-select2>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="movie_id" class="col-sm-2 col-form-label">Movies</label>
                                    <div class="col-sm-10">
                                        <x-adminlte-select2 name="movie_id" id="movie_id" required
                                                            :config="['disabled'=> isset($show) ? true : false]">
                                            <x-adminlte-options :options="$movies"
                                                                placeholder="-- Select Movie --"/>
                                        </x-adminlte-select2>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="screen_id" class="col-sm-2 col-form-label">Screens</label>
                                    <div class="col-sm-10">
                                        <x-adminlte-select2 name="screen_id" id="screen_id" required
                                                            :config="['disabled'=> isset($show) ? true : false]">
                                            <x-adminlte-options :options="(isset($screens) ? $screens : '' )"
                                                                placeholder="-- Select Screen --"/>
                                        </x-adminlte-select2>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="show_id" class="col-sm-2 col-form-label">Shows</label>
                                    <div class="col-sm-10">
                                        <x-adminlte-select2 name="show_id" id="show_id" required
                                                            :config="['disabled'=> isset($show) ? true : false]">
                                            <x-adminlte-options :options="(isset($screens) ? $screens : '' )"
                                                                placeholder="-- Select Show --"/>
                                        </x-adminlte-select2>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ticket_count" class="col-sm-2 col-form-label">Total Tickets</label>
                                    <div class="col-sm-10">
                                        <x-adminlte-select2 name="ticket_count" id="ticket_count" required
                                                            :config="['disabled'=> isset($show) ? true : false]">
                                            <x-adminlte-options :options="$ticketCount"
                                                                placeholder="-- Total Tickets --"/>
                                        </x-adminlte-select2>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="demo" class="col-sm-2 col-form-label">demo</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('demo') is-invalid @enderror"
                                               id="demo" name="demo" placeholder="Enter demo"
                                               required
                                               data-rule-maxlength='50'>
                                        @error('demo')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    @include('operator.seats.seat-menu')

                </div>
            </div>
        </div>
    </section>
    </body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @include('operator.seats.jquery')

@stop

@section('css')

    <link href="{{ asset('/datatable/css/dataTables.bulma.min.css') }}" rel="stylesheet">

    <link href="{{ asset('/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">

@stop

@section('js')
    <script src="//cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
@stop

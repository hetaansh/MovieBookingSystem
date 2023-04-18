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

                            <form action="">
                                @csrf

                                <div class="form-group row">
                                    <label for="cinema_id" class="col-sm-2 col-form-label">Cinema</label>
                                    <div class="col-sm-10">
                                        <x-adminlte-select2 name="cinema_id" id="cinema_id" required
                                                            :config="['disabled'=> isset($show) ? true : false]">
                                            <x-adminlte-options :options="$cinemas"
                                                                :selected="(isset($show)? $show->screen->cinema_id : old('cinema_id'))"
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
                                                                :selected="(isset($show)? $show->screen->cinema_id : old('movie_id'))"
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
                                                                :selected="(isset($show) ? $show->screen_id : old('screen_id'))"
                                                                placeholder="-- Select Screen --"/>
                                        </x-adminlte-select2>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="show_id" class="col-sm-2 col-form-label">Screens</label>
                                    <div class="col-sm-10">
                                        <x-adminlte-select2 name="show_id" id="show_id" required
                                                            :config="['disabled'=> isset($show) ? true : false]">
                                            <x-adminlte-options :options="(isset($screens) ? $screens : '' )"
                                                                :selected="(isset($show) ? $show->screen_id : old('show_id'))"
                                                                placeholder="-- Select Show --"/>
                                        </x-adminlte-select2>
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


    <script>
        $(document).ready(function () {

            $('#show_id').change(function () {
                let show_id = $(this).val();
                console.log(show_id)
            });

            $('#movie_id, #screen_id').change(function () {
                let movie_id = $('#movie_id').val();
                let screen_id = $('#screen_id').val();
                console.log(screen_id);
                if (screen_id != '' && movie_id != '') {
                    $.ajax({
                        url: 'seats/getShows',
                        type: 'post',
                        data: 'screen_id=' + screen_id + '&movie_id=' + movie_id + '&_token={{csrf_token()}}',
                        success: function (result) {
                            $('#show_id').html('<option value="">-- Select Show --</option>');
                            $.each(result, function (key, value) {
                                $("#show_id").append('<option value="' + value
                                    .id + '">' + value.start_at + " to " + value.end_at + '</option>');
                            });
                        }
                    });
                } else {
                    $('#show_id').html('<option value="">-- Select Screen --</option>');
                }
            });


            $('#cinema_id').change(function () {
                let cinema_id = $(this).val();
                // $('#movie_id').change(function () {
                //     let movie_id = $('#movie_id').val();
                if (cinema_id != '') {
                    $.ajax({
                        url: 'seats/getScreen',
                        type: 'post',
                        data: 'cinema_id=' + cinema_id + '&_token={{csrf_token()}}',
                        success: function (result) {
                            $('#screen_id').html('<option value="">-- Select Screen --</option>');
                            $.each(result, function (key, value) {
                                $("#screen_id").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#screen_id').html('<option value="">-- Select Cinema --</option>');
                }
                // });
            });


            $('#screen_id').change(function () {
                let screen_id = $(this).val();
                $("#section").load(location.href + " #section");
                if (screen_id != '') {
                    $.ajax({
                        url: 'seats/getSeats',
                        type: 'post',
                        data: 'screen_id=' + screen_id + '&_token={{csrf_token()}}',
                        success: function (result) {
                            $('<div class="screen"></div>').appendTo('#screen_section')

                            const letter = 'A'.charCodeAt(0);
                            for (let i = letter; i < (letter + result.rows); i++) {
                                var index_letter = $('<p>' + String.fromCharCode(i) + '</p>')
                                index_letter.appendTo('#index');
                            }

                            const aCharCode = 'A'.charCodeAt(0);
                            for (let i = aCharCode; i < (aCharCode + result.rows); i++) {
                                var row = $('<tr></tr>');
                                for (var x = 1; x <= result.cols; x++) {
                                    $('<td id="' + String.fromCharCode(i) + ' ' + x + '">' + x + '</td>').appendTo(row);
                                }
                                row.appendTo('#seats_formation');
                            }
                        }
                    });
                }
            });
            var seat_array = new Set();
            $(document).on("click", "#seats_formation td", function (e) {
                var data = $(this).attr('id');
                this.style.backgroundColor = this.style.backgroundColor == 'green' ? 'white' : 'green';
                if (this.style.backgroundColor == 'green') {
                    seat_array.add(data);
                }
                if (this.style.backgroundColor == 'white') {
                    seat_array.delete(data);
                }
                console.log(seat_array);

            });

        })


    </script>

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

    <link href="{{ asset('/datatable/css/dataTables.bulma.min.css') }}" rel="stylesheet">

    <link href="{{ asset('/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">

@stop

@section('js')
    <script src="//cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
@stop

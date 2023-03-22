@extends('adminlte::page')

@section('title', 'Operators')

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
                            <div style="padding-bottom:20px;float:right">
                                <a class="btn btn-sm btn-secondary mx-2 " href="{{ route('operators.create') }}">Add Operator</a>
                            </div>


                            <table id="table1" class="table table-striped table-bordered" style="text-align: center;">
                                <thead style="background-color: #e9ecef;">
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">Name</th>
                                        <th style="text-align: center;">City</th>
                                        <th style="width:150px;text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <thead style="background-color: #e9ecef;">
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">Name</th>
                                        <th style="text-align: center;">City</th>
                                        <th style="width:150px;text-align: center;">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>  
</body>

<script type="text/javascript">
    var table;

    $(document).ready(function() {
        table = $('#table1').dataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("operators.datatable") }}'
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'city.name',
                    name: 'city.name'
                },
                {
                    data: function(row) {
                        return '<a class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit" href="operators/' + row.id + '/edit" value="' + row.id + '"> ' + '<i class="fa fa-lg fa-fw fa-pen"></i>' + '</a>' +
                            '<a class="button btn btn-xs btn-default text-primary mx-1 shadow" title="Delete" data-id="' + row.id + '"> ' + '<i class="fa fa-lg fa-fw fa-trash"></i>' + '</a>'
                    },
                    name: 'id',
                },
            ]
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $(document).on('click', '.button', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "{{ url('admin/operators') }}/" + id,
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: "DELETE",
                    },
                    success: function(data) {
                        Swal.fire(
                            'Deleted!',
                            data,
                            'success'
                        );
                        table.fnDraw();
                    },
                    error: function(data) {
                        Swal.fire(
                            'Oops!',
                            data.responseText,
                            'error'
                        )
                    }
                });
            }
        });
    });
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
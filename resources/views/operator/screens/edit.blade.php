@extends('adminlte::page')

@section('title', 'Update Screen')




@section('content')
    <style>
        tr td {
            width: 32px;
            height: 30px;
            text-align: center;
            border: solid;
            border-width: thin;
            background-color: white;
        }

        table {

            padding-bottom: 20px;
            padding-top: 20px;
            border-collapse: separate;
            border-spacing: 10px;
            display: inline-block;
        }

        .screen {
            margin-left: auto;
            margin-right: auto;
            background-color: white;
            height: 120px;
            width: 25%;
            transform: rotateX(-48deg);
            box-shadow: 0 3px 10px;

        }

        .flex-container {
            display: flex;
            justify-content: center;
        }

        .index {
            padding-top: 32px;
            margin-right: 15px;
            font-weight: bold;

        }


    </style>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('screens.index') }}">{{ $title }}</a></li>
                            <li class="breadcrumb-item active"><a>Edit</a></li>
                        </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Edit Screen</h3>
        </div>
        <form class="form-horizontal" data-validate="true" novalidate
              action="{{ route('screens.update', $screen->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('operator.screens._form')

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-default float-right" href="{{route('screens.index')}}">Cancel</a>
            </div>

        </form>
    </div>


    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Screen</h3>
            </div>
            <div class="card-body p-0" style="background-color: whitesmoke">
                <div class="bs-stepper linear">
                    <div class="bs-stepper-header" role="tablist">
                        <div id="section">

                            <div class="screen">
                            </div>



                                <div class="flex-container">
                                    <div class="index">
                                        <?php
                                        $letter = 'A';
                                        ?>
                                        @for($i = 1; $i <= $screen->rows; $i++)
                                            <p>{{ $letter }}</p>
                                                <?php
                                                $letter++;
                                                ?>
                                        @endfor
                                    </div>

                                    <table id="seats_formation">

                                        @for($i = 1; $i <= $screen->rows; $i++)
                                            <tr>
                                                @for($j = 1; $j <= $screen->cols; $j++)
                                                    <td>
                                                        {{ $j }}
                                                    </td>

                                                @endfor

                                            </tr>
                                        @endfor
                                    </table>
                                </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

@stop

@section('js')
    @include('super_admin.__jquery_validations')
@stop

@extends('adminlte::page')

@section('title', 'Add Movie')




@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('operators.create') }}">Add</a></li>
                    <li class="breadcrumb-item active"><a style="color:#6c757d" href="{{ route('movies.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">{{ $user }}</li>
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
@include('super_admin.__jquery_validations')
@stop
@extends('adminlte::page')

@section('title', 'Add City')




@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cities.index') }}">{{ $title }}</a></li>
                    <li class="breadcrumb-item active"><a>Add</a></li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Add City</h3>
    </div>


    <form class="form-horizontal" data-validate="true" novalidate action="{{ route('cities.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('super_admin.cities._form')

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-default float-right" href="{{route('cities.index')}}">Cancel</a>
        </div>

    </form>
</div>
@stop

@section('js')
@include('super_admin.__jquery_validations')
@stop
@extends('adminlte::page')

@section('title', 'Update Operator')




@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('admin/operators/' . $operator->id . '/edit') }}">Edit</a></li>
                    <li class="breadcrumb-item active"><a style="color:#6c757d" href="{{ route('operators.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">{{ $user }}</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Edit Operator</h3>
    </div>

    <form class="form-horizontal" data-validate="true" novalidate action="{{ route('operators.update', $operator->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('super_admin.operators._form')
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-default float-right" href="{{route('operators.index')}}">Cancel</a>
        </div>

    </form>
</div>


@stop

@section('js')
@include('super_admin.__jquery_validations')
@stop
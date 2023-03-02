@extends('adminlte::page')

@section('title', 'Operator Users')

@section('content')



<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>DataTables</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">{{ $user }}</a></li>
                    <li class="breadcrumb-item active">DataTables</li>
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
                            <a class="btn btn-sm btn-secondary mx-2 " href="{{ route('operatorUsers.create') }}">Add Operator User</a>
                        </div>


                        <x-adminlte-datatable id="table1" :heads="$heads" hoverable with-footer head-theme="light" footer-theme="light" beautify>

                            @foreach($data as $operators)
                            <tr>
                                <td>{{$operators->id}}</td>
                                <td>{{$operators->operator_id}}</td>
                                <td>{{$operators->name}}</td>
                                <td>{{$operators->email}}</td>
                                <td>
                                    @auth('admin')
                                    <a class="btn btn-xs btn-default text-primary mx-1 shadow" onclick="return confirm('Are you sure you want to delete this data?')" href="{{url('/admin/operatorUsers/'.$operators->id)}}"><i class="fa fa-lg fa-fw fa-trash"></i></a>

                                    <a class="btn btn-xs btn-default text-primary mx-1 shadow" onclick="return confirm('Are you sure you want to update this data?')" href="{{url('/admin/operatorUsers/'.$operators->id.'/edit')}}"><i class="fa fa-lg fa-fw fa-pen"></i></a>
                                    @endauth
                                    @auth('operator')
                                    <a class="btn btn-xs btn-default text-primary mx-1 shadow" onclick="return confirm('Are you sure you want to delete this data?')" href="{{url('/operator/operatorUsers/'.$operators->id)}}"><i class="fa fa-lg fa-fw fa-trash"></i></a>

                                    <a class="btn btn-xs btn-default text-primary mx-1 shadow" onclick="return confirm('Are you sure you want to update this data?')" href="{{url('/operator/operatorUsers/'.$operators->id.'/edit')}}"><i class="fa fa-lg fa-fw fa-pen"></i></a>
                                    @endauth
                                </td>
                            </tr>
                            @endforeach

                        </x-adminlte-datatable>
                    </div>
                </div>


                    @stop
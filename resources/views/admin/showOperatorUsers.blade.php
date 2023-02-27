@extends('adminlte::page')

@section('title', 'Operator Users')

@section('content')

@php
$heads = [
'ID',
'Name',
['label' => 'Email', 'width' => 40],
'City',
'Operators',
['label' => 'Actions', 'no-export' => true, 'width' => 5],
];


@endphp

<div style="padding:20px;float:right">
    <a class="btn btn-sm btn-secondary mx-2 " href="{{ route('admin.operatorUsers.show') }}">Add Operator User</a>
</div>


<x-adminlte-datatable id="table1" :heads="$heads"  hoverable with-footer head-theme="light" footer-theme="light" beautify>

    @foreach($data as $operatorUsers)
    <tr>
        <td>{{$operatorUsers->id}}</td>
        <td>{{$operatorUsers->name}}</td>
        <td>{{$operatorUsers->email}}</td>
        <td>{{$operatorUsers->city}}</td>
        <td>{{$operatorUsers->operator}}</td>
        <td>
            <a class="btn btn-xs btn-default text-primary mx-1 shadow" onclick="return confirm('Are you sure you want to delete this data?')" href="{{url('/admin/operatorUsers/delete',$operatorUsers->id)}}"><i class="fa fa-lg fa-fw fa-trash"></i></a>
       
            <a class="btn btn-xs btn-default text-primary mx-1 shadow" onclick="return confirm('Are you sure you want to update this data?')" href="{{url('/admin/operatorUsers/update',$operatorUsers->id)}}"><i class="fa fa-lg fa-fw fa-pen"></i></a>
        </td>
    </tr>
    @endforeach

</x-adminlte-datatable>




@stop
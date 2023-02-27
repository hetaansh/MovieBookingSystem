@extends('adminlte::page')

@section('title', 'Operators')

@section('content')

@php
$heads = [
'ID',
'Name',
['label' => 'Email', 'width' => 40],
'City',
['label' => 'Actions', 'no-export' => true, 'width' => 5],
];


@endphp

<div style="padding:20px;float:right">
    <a class="btn btn-sm btn-secondary mx-2 " href="{{ route('admin.operators.show') }}">Add Operator</a>
</div>


<x-adminlte-datatable id="table1" :heads="$heads"  hoverable with-footer head-theme="light" footer-theme="light" beautify>

    @foreach($data as $operators)
    <tr>
        <td>{{$operators->id}}</td>
        <td>{{$operators->name}}</td>
        <td>{{$operators->email}}</td>
        <td>{{$operators->city}}</td>
        <td>
            <a class="btn btn-xs btn-default text-primary mx-1 shadow" onclick="return confirm('Are you sure you want to delete this data?')" href="{{url('/admin/operators/delete',$operators->id)}}"><i class="fa fa-lg fa-fw fa-trash"></i></a>
       
            <a class="btn btn-xs btn-default text-primary mx-1 shadow" onclick="return confirm('Are you sure you want to update this data?')" href="{{url('/admin/operators/update',$operators->id)}}"><i class="fa fa-lg fa-fw fa-pen"></i></a>
        </td>
    </tr>
    @endforeach

</x-adminlte-datatable>




@stop
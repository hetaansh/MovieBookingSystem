@extends('adminlte::page')

@section('title', 'Dashboard')



@section('content_header')
    <h1>Dashboard</h1>
@stop


@section('content')


                     @can('isAdmin')
                        <p>Welcome to this beautiful Admin panel.</p>
                    @elsecan('isUser')
                        <p>Welcome to this beautiful user panel.</p>
                        @elsecan('isOperator')
                        <p>Welcome to this beautiful operator panel.</p>
                    @endcan
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop


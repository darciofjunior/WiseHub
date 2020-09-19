@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Olá <b>{{ Auth::user()->nome }}</b>,
        seja bem Vindo ao nosso DashBoard !!!</h1>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
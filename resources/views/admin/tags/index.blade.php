@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Tags</h1>
@stop

@section('content')
<livewire:admin.tags-index />
@stop

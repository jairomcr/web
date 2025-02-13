@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Productos</h1>
@stop

@section('content')
<livewire:admin.product-index />
@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{--
<link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script src="{{ asset('assets/js/bs-custom-file-input.min.js') }}"></script>
@stop
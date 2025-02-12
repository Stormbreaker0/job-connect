@extends('layouts.admin.main')
@section('content')

<div id="app">
    <form-component></form-component>
</div>


@vite('resources/js/app.js')



<style>
    .note-insert {
        display: none!important;
    }
    .error {
        color: red;
        font-weight: bold;
    }
</style>
@endsection
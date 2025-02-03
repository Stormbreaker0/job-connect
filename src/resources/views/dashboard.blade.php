@extends('layouts.app')


@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">

        @if(Session::has('success'))
		<div class="alert alert-success">{{Session::get('success')}}</div>
		@endif

		@if(Session::has('error'))
		<div class="alert alert-danger">{{Session::get('error')}}</div>
		@endif

        <div class="container-fluid px-4">
			<h1 class="mt-4">Dashboard</h1>
			<p>Hello, {{ auth()->user()->name }}
			<p>
				@if(! auth()->user()->billing_ends)
				@if(Auth::check() && auth()->user()->user_type == 'employer')
			<p>Your trial {{now()->format('Y-m-d') > auth()->user()->user_trial ? 'was expired': 'will expire'}} on {{auth()->user()->user_trial}}</p>
			@endif
			@endif
			@if(Auth::check() && auth()->user()->user_type == 'employer')
			<p>Your membership {{now()->format('Y-m-d') > auth()->user()->billing_ends ? 'was expired': 'will expire'}} on {{auth()->user()->billing_ends}}</p>
			@endif
			<div class="row">

				<div class="container">
    </div>
</div>


@endsection
@extends('layouts.admin.main')


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
			<ol class="breadcrumb mb-4">
				{{-- <li class="breadcrumb-item active">Hello, {{ Auth::user()->name }}</li> --}}
				<li class="breadcrumb-item active">
					@if(Auth::check() && Auth::user()->user_type == 'employer')
						@if(! Auth::user()->billing_ends)
							Your trial {{ now()->format('Y-m-d') > Auth::user()->user_trial ? 'was expired' : 'will expire' }} on {{ Auth::user()->user_trial }}
						@elseif(Auth::user()->billing_ends)
							Your membership {{ now()->format('Y-m-d') > Auth::user()->billing_ends ? 'was expired' : 'will expire' }} on {{ Auth::user()->billing_ends }}
						@endif
					@endif
				</li>
			</ol>
			<div class="row">

				<div class="container">
					<div class="row">
						<div class="col-md-4 col-xl-3">
							<div class="card bg-c-blue order-card">
								<div class="card-block">
									<h6 class="m-b-20">Total jobs posted</h6>
									<h2 class="text-right"><i class="fa fa-cart-plus f-left"></i>&nbsp;&nbsp;<span>{{\App\Models\Listing::where('user_id',auth()->id())->count()}}</span></h2>
									<p class="m-b-0">Your jobs<span class="f-right">{{\App\Models\Listing::where('user_id',auth()->id())->count()}}</span></p>
								</div>
							</div>
						</div>

						<div class="col-md-4 col-xl-3">
							<div class="card bg-c-green order-card">
								<div class="card-block">
									<h6 class="m-b-20">Company Profile</h6>
									<h2 class="text-right"><i class="fa fa-rocket f-left"></i><span>&nbsp;&nbsp;1</span></h2>
									<p class="m-b-0">Your profile<span class="f-right">1</span></p>
								</div>
							</div>
						</div>

						<div class="col-md-4 col-xl-3">
							<div class="card bg-c-yellow order-card">
								<div class="card-block">
									<h6 class="m-b-20">Subscription</h6>
									<h2 class="text-right"><i class="fa fa-refresh f-left"></i><span>$80</span></h2>
									<p class="m-b-0">Monthly<span class="f-right"></span>$80/month</p>
								</div>
							</div>
						</div>

						<div class="col-md-4 col-xl-3">
							<div class="card bg-c-pink order-card">
								<div class="card-block">
									<h6 class="m-b-20">Total applicants</h6>
									<h2 class="text-right"><i class="fa fa-credit-card f-left"></i><span>18</span></h2>
									<p class="m-b-0">Your applicants<span class="f-right">18</span></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


		</div>
	</div>
	<style>
		.order-card {
			color: #fff;
		}

		.bg-c-blue {
			background: linear-gradient(45deg, #4099ff, #73b4ff);
		}

		.bg-c-green {
			background: linear-gradient(45deg, #2ed8b6, #59e0c5);
		}

		.bg-c-yellow {
			background: linear-gradient(45deg, #FFB64D, #ffcb80);
		}

		.bg-c-pink {
			background: linear-gradient(45deg, #FF5370, #ff869a);
		}


		.card {
			border-radius: 5px;
			-webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
			box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
			border: none;
			margin-bottom: 30px;
			-webkit-transition: all 0.3s ease-in-out;
			transition: all 0.3s ease-in-out;
		}

		.card .card-block {
			padding: 25px;
		}

		.order-card i {
			font-size: 26px;
		}

		.f-left {
			float: left;
		}

		.f-right {
			float: right;
		}
	</style>
	@endsection
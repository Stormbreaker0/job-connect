@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title">Weekly — €9.99</h5>
                      <p class="card-text">Get access to all job listings for one week. Perfect for short-term job seekers.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Access to all job listings</li>
                      <li class="list-group-item">Email notifications</li>
                      <li class="list-group-item">Basic support</li>
                    </ul>
                    <div class="card-body text-center">
                      <a href="{{ route('pay.weekly') }}" class="card-link">
                        <button class="btn btn-success">Subscribe</button>
                      </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title">Monthly — €29.99</h5>
                      <p class="card-text">Enjoy a full month of access to all job listings. Ideal for those who need more time to find the perfect job.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Access to all job listings</li>
                      <li class="list-group-item">Priority email notifications</li>
                      <li class="list-group-item">Priority support</li>
                    </ul>
                    <div class="card-body text-center">
                      <a href="{{ route('pay.monthly') }}" class="card-link">
                        <button class="btn btn-success">Subscribe</button>
                      </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title">Yearly — €149.99</h5>
                      <p class="card-text">Get a full year of access to all job listings. Best value for long-term job seekers.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Access to all job listings</li>
                      <li class="list-group-item">Premium email notifications</li>
                      <li class="list-group-item">Premium support</li>
                    </ul>
                    <div class="card-body text-center">
                      <a href=" {{ route('pay.yearly') }} " class="card-link">
                        <button class="btn btn-success">Subscribe</button>
                      </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
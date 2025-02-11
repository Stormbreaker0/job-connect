@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center mt-2">
    <div class="col">
      <div class="hero-section" style="background-color:#f5f5f5;width:100%;height:200px;">
        <!-- <img src="" style="width: 100%; height:250px;"> -->
      </div>
    </div>
  </div>
  
  <div class="row mt-5">
    <div class="col">
      @if($company->profile_pic)
        <img src="{{ Storage::url($company->profile_pic) }}" alt="Company Logo" class="img-fluid" width="700px">
      @else
        <img src="{{asset('image/default-company.png')}}" alt="Default Company Logo" class="img-fluid" width="700px">
      @endif
      <h2>{{$company->name}}</h2>
      <p>{{$company->address}}</p>
    </div>
  </div>
  
  <div class="row mt-5">
    <div class="col">
      <h3>About</h3>
      @if($company->about)
        {{$company->about}}
      @else
        <p>We are a company dedicated to providing efficient and innovative solutions for every need. With a qualified team and extensive experience in our industry, we are committed to ensuring quality and reliability in everything we do. Our mission is to build lasting relationships with our clients by offering products and services that meet their needs, with the goal of helping them grow and succeed.

          We believe in the importance of continuous evolution and innovation, always staying at the forefront to deliver the highest value and satisfaction.
        </p>
      @endif
    </div>
  </div>
  
  <div class="row mt-5">
    <div class="col-md-8">
      <h3>List of Jobs</h3>
      @foreach($company->jobs as $job)
      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title">{{$job->title}}</h5>
          <p class="card-text">Location: {{$job->address}}</p>
          <p class="card-text">Salary: €{{number_format($job->salary)}} per year</p>
          <a href="{{route('job.show',[$job->slug])}}" class="btn btn-dark">View</a>
        </div>
      </div>   
      @endforeach
    </div>
  </div>
</div>

@endsection
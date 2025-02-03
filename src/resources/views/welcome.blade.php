@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="jumbotron text-center bg-light p-5 rounded">
        <h1 class="display-4">Welcome to Job Linker</h1>
        <p class="lead">Connecting job seekers with employers seamlessly.</p>
        <hr class="my-4">
        <p>Find your dream job or the perfect candidate today.</p>
        <a class="btn btn-primary btn-lg" href="{{ route('create.seeker') }}" role="button">I'm a Job Seeker</a>
        <a class="btn btn-secondary btn-lg" href="{{ route('create.employer') }}" role="button">I'm an Employer</a>
    </div>

    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card">
                <img src="https://placehold.co/300x200" class="card-img-top" alt="Job Search">
                <div class="card-body">
                    <h5 class="card-title">Job Search</h5>
                    <p class="card-text">Explore thousands of job listings from top companies.</p>
                    <a href="#" class="btn btn-primary">Search Jobs</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="https://placehold.co/300x200" class="card-img-top" alt="Post a Job">
                <div class="card-body">
                    <h5 class="card-title">Post a Job</h5>
                    <p class="card-text">Reach out to millions of job seekers by posting your job openings.</p>
                    <a href="#" class="btn btn-primary">Post a Job</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="https://placehold.co/300x200" class="card-img-top" alt="Career Advice">
                <div class="card-body">
                    <h5 class="card-title">Career Advice</h5>
                    <p class="card-text">Get expert advice on career development and job search strategies.</p>
                    <a href="#" class="btn btn-primary">Get Advice</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
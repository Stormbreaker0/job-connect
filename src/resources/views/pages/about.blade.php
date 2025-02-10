@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">About Us</h1>
    <div class="row">
        <div class="col-md-6">
            <p>Welcome to Job-Connect! We are dedicated to connecting job seekers with their dream jobs and helping employers find the perfect candidates. Our platform offers a wide range of job listings across various industries and locations. Our mission is to make the job search process as smooth and efficient as possible for everyone involved.</p>
        </div>
        <div class="col-md-6">
            <img src="{{ asset('image/connect.jpg') }}" alt="Job-Connect" class="img-fluid rounded">
        </div>
    </div>
    

    <h2 class="mt-5">Our Mission</h2>
    <p>Our mission is to bridge the gap between job seekers and employers by providing a user-friendly platform that simplifies the job search and hiring process. We strive to create a community where both job seekers and employers can find the resources and support they need to succeed.</p>
 
    <h2 class="mt-4">Our Values</h2>
    <ul>
        <li><strong>Integrity:</strong> We believe in conducting our business with honesty and transparency.</li>
        <li><strong>Innovation:</strong> We are constantly looking for new ways to improve our platform and services.</li>
        <li><strong>Customer Focus:</strong> Our users are at the heart of everything we do.</li>
        <li><strong>Excellence:</strong> We are committed to delivering the highest quality service.</li>
    </ul>

    <h1 class="mt-5">Contact Us</h1>
    <p>If you have any questions, feedback, or need assistance, please feel free to reach out to us. We are here to help!</p>
    
    <h2 class="mt-4">Email</h2>
    <p>You can email us at <a href="mailto:support@joblinker.com">support@joblinker.com</a></p>
    
    <h2 class="mt-4">Phone</h2>
    <p>Call us at (123) 456-7890</p>
    
    <h2 class="mt-4">Address</h2>
    <p>Job-Connect Inc.<br>
    123 Job Street<br>
    Ferrara City, EC 12345</p>
</div>

@endsection
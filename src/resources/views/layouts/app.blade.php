<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Job-Connect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
    </style>

    <style> 
        body {
            background: url('{{ asset('image/background.eps') }}') no-repeat center center fixed;
            background-size: cover;
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

    <nav class="navbar navbar-expand-lg bg-dark shadow-lg" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src={{asset('image/logo.png')}} alt="Job-Connect Logo" width="40" height="40" class="d-inline-block align-text-top">
                Job-Connect
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('about') }}">About</a>
                    </li>
                    @if(Auth::check())
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(Auth::user()->profile_pic)
                            <img src="{{ Storage::url(Auth::user()->profile_pic) }}" width="40" class="rounded-circle">
                            @else
                            <img src="https://placehold.co/400" class="rounded-circle" width="40">
                            @endif
                        </a>
                        <ul class="dropdown-menu">
                            @if(Auth::user()->user_type === 'seeker')
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('seeker.profile') }}">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('job.applied') }}">Job applied</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="logout" href="#">Logout</a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="logout" href="#">Logout</a>
                            </li>
                            @endif
                        </ul>
                    </li>

                    @endif
                    @if(!Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('create.seeker') }}">Job Seeker</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="{{ route('create.employer') }}">Company</a>
                    </li>
                    @endif

                    <form id="form-logout" action="{{ route('logout') }}" method="post">@csrf </form>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>

    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">&copy; <span id="currentYear"></span> Job-Connect. All rights reserved.</div>
                <div>
                    <a href="{{ route('privacy') }}">Privacy Policy</a>
                    &middot;
                    <a href="{{ route('terms') }}">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        let logout = document.getElementById('logout');
        let form = document.getElementById('form-logout');
        logout.addEventListener('click', function() {
            form.submit();
        })
    </script>

    <script>
        let currentYear = document.getElementById('currentYear');
        currentYear.textContent = new Date().getFullYear();
    </script>

</body>

</html>
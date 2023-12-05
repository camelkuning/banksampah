<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ strip_tags(config('app.title', 'Home')) }} | {{ config('app.name', 'Laravel') }}</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('assets/css') }}/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css') }}/fontawesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css') }}/bsadmin.css">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Static -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Font Popins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600;700&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- Bootstreap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    @stack('css')
</head>

<body>

    <nav class="navbar navbar-expand navbar-dark bg-primary">
        <a class="sidebar-toggle text-light mr-3"><i class="fa fa-bars"></i></a>
        <a class="navbar-brand" href="#"><i class="fa fa-code-branch"></i> SIBASAM</a>
        <div class="navbar-collapse collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown">
                        <i class="bi bi-person-circle"></i> {{ Auth::user()->username }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                            <i class="bi bi-person-circle mr-3"></i>Profile
                        </a>
                        <a class="dropdown-item" href="/login">
                            <i class="bi bi-box-arrow-right mr-3"></i>Logout
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="d-flex">
        @include('layouts.sidebar')

        @yield('content')
    </div>

    <script src="{{ asset('assets/js') }}/jquery.min.js"></script>
    <script src="{{ asset('assets/js') }}/popper.min.js"></script>
    <script src="{{ asset('assets/js') }}/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js') }}/bsadmin.js"></script>
    @stack('js')
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - AJAX CRUD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/dashboard_custom.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/toastify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/jquery.dataTables.min.css') }}">

    @yield('styles') <!-- Page-specific styles -->
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block bg-dark sidebar text-white vh-100">
                <div class="text-center py-4">
                    <h5>AJAX CRUD</h5>
                </div>
                <ul class="nav flex-column px-3">
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white {{ request()->routeIs('employee.page') ? 'active fw-bold' : '' }}" href="{{ route('employee.page') }}">Employee</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white {{ request()->routeIs('department.page') ? 'active fw-bold' : '' }}" href="{{ route('department.page') }}">Department</a>
                    </li>
                </ul>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 py-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- JS Scripts -->
    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    {{-- <script src="{{ asset('js/bootstrap.bundle.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/toastify.min.js') }}"></script>

    @yield('scripts') <!-- Page-specific JS -->
</body>
</html>

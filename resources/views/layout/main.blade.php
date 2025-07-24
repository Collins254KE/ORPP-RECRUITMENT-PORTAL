<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ORPP - E-RECRUITMENT PORTAL</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('assets/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
     <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome (optional for icons) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">


    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <style>
        /* Custom styles for the dashboard layout */
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            font-family: 'Inter', sans-serif;
        }

        .sidebar {
            width: 250px;
            background-color: #ffff;
            /* Silver background for sidebar */
            color: white;
            /* Change text color for better contrast */
            position: fixed;
            height: 100%;
            padding-top: 20px;
            transition: width 0.3s;
            /* Smooth transition for responsive design */
        }

        .sidebar a {
            color: black;
            /* Change link color for better contrast */
            padding: 10px 15px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s;
            /* Smooth hover effect */
        }

        .sidebar a:hover {
            background-color: #007bff;
            /* Darker shade on hover */
        }

        .nav-link {
            color: #007bff;
            /* Default link color */
            text-decoration: none;
            /* Remove underline */
        }

        .nav-link.active {
            color: #fff;
            background-color: #007bff;
            font-weight: bold;
            border-radius: 4px;
            padding: 8px 12px;
        }

        .topbar {
            background-color: #007bff;
            /* Silver background for topbar */
            color: black;
            /* Change text color for better contrast */
            padding: 10px 15px;
            position: fixed;
            width: calc(100% - 250px);
            /* Adjust for sidebar width */
            top: 0;
            left: 250px;
            /* Adjust for sidebar width */
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            /* Space between toggle and profile */
            align-items: center;
            /* Center items vertically */
        }

        .content {
            margin-left: 250px;
            /* Adjust for sidebar width */
            padding-top: 60px;
            /* Adjust for topbar height */
            margin-top: 40px;
            /* Add margin top to content */
            flex: 1;
            background-color: white;
            /* Light gray background for content */
            padding: 20px;
            transition: margin-left 0.3s;
            /* Smooth transition for responsive design */
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
                /* Adjust sidebar width for smaller screens */
            }

            .topbar {
                left: 200px;
                /* Adjust for smaller sidebar */
                width: calc(100% - 200px);
                /* Adjust for smaller sidebar */
            }

            .content {
                margin-left: 200px;
                /* Adjust for smaller sidebar */
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                width: 100%;
                /* Full width on small screens */
                position: relative;
                /* Change to relative for stacking */
            }

            .topbar {
                left: 0;
                /* Full width on small screens */
                width: 100%;
                /* Full width on small screens */
            }

            .content {
                margin-left: 0;
                /* No margin on small screens */
                margin-top: 40px;
                /* Maintain margin top on small screens */
            }
        }
    </style>
       @yield('styles')
</head>

<body>

    <nav class="sidebar">
        <h2>ORPP Portal</h2>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">Home</a>
            </li>
            @if(Auth::user()->is_staff && (Auth::user()->role == 'admin' || Auth::user()->role == 'hr'))
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/job-listings') ? 'active' : '' }}" href="/admin/job-listings">Job Listings</a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link {{ request()->is('profile') ? 'active' : '' }}" href="/profile">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('applications') ? 'active' : '' }}" href="/applications">Job
                    Applications</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('my-applications') ? 'active' : '' }}" href="/my-applications">My
                    Applications</a>
            </li>
            <li class="nav-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a class="nav-link" href="#"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            </li>
            @endif
        </ul>
    </nav>

    <div class="topbar">
        <button class="btn btn-light" id="sidebarToggle">
            <i class="bi bi-list"></i>
        </button>

        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="bi bi-person-circle"></i> <!-- Bootstrap Icons for profile -->
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                <li class="dropdown-header">Welcome, {{ Auth::user()->name }}</li>
                <li><a class="dropdown-item" href="/profile">Profile</a></li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="dropdown-item" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="content">
        <main>
            @yield('content')
        </main>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        // Toggle sidebar visibility
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            const sidebar = document.querySelector('.sidebar');
            const topbar = document.querySelector('.topbar');
            const content = document.querySelector('.content');

            if (sidebar.style.display === 'none' || sidebar.style.display === '') {
                sidebar.style.display = 'block';
                content.style.marginLeft = '250px';
                topbar.style.width = 'calc(100% - 250px)';
                topbar.style.left = '250px';
            } else {
                sidebar.style.display = 'none';
                content.style.marginLeft = '0';
                topbar.style.width = '100%';
                topbar.style.left = '0';
            }
        });
    </script>
    @yield('scripts')
    @stack('scripts')

</body>

</html>
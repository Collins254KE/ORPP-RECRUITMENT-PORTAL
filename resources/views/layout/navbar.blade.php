<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="index.html" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
        <h1 class="m-0 text-primary">ORPP E-RECRUITMENT PORTAL</h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="/" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
            <a href="/about" class="nav-item nav-link {{ request()->is('about') ? 'active' : '' }}">About</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">View</a>
                <div class="dropdown-menu rounded-0 m-0">
                    <a href="job-detail.html" class="dropdown-item">Job Detail</a>
                </div>
            </div>
            <a href="/partners" class="nav-item nav-link {{ request()->is('partners') ? 'active' : '' }}">Partners</a>
            
            <a href="/contact" class="nav-item nav-link {{ request()->is('contact') ? 'active' : '' }}">Contact</a>
            
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Account</a>
                <div class="dropdown-menu rounded-0 m-0">
                    <a href="/auth/login" class="dropdown-item">login</a>
                    <a href="/auth/register" class="dropdown-item">Register</a>
                </div>
            </div>
        </div>
    </div>
</nav>
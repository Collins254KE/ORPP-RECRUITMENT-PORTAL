<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'ORPP e-Recruitment Portal'); ?></title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8fafc;
        }
        .header-logo {
            display: block;
            margin: 20px auto 10px auto;
            height: 200px; /* Increased image size */
        }
        .header-title {
            text-align: center;
            font-size: 1.8rem;
            font-weight: bold;
            color: #0d6efd;
            margin-bottom: 10px;
        }
    </style>

    <?php echo $__env->yieldContent('styles'); ?>
</head>

<body>
<div id="app">

    <!-- Header with Logo and Title -->
    <div class="text-center py-3 bg-white shadow-sm">
        <img src="/assets/img/images.png" alt="ORPP Logo" class="header-logo">
        <div class="header-title">ORPP e-Recruitment Portal</div>
    </div>

    <!-- Navbar for Login/Register -->
    <nav class="navbar navbar-expand-md navbar-light bg-white border-bottom">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarContent" aria-controls="navbarContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
                <ul class="navbar-nav ms-auto">
                    <?php if(auth()->guard()->guest()): ?>
                        <?php if(Route::has('login')): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('login')); ?>">Login</a>
                            </li>
                        <?php endif; ?>
                        <?php if(Route::has('register')): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('register')); ?>">Register</a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</div>

<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php echo $__env->yieldContent('scripts'); ?>

</body>
</html>
<?php /**PATH C:\orpp6\resources\views\layouts\app.blade.php ENDPATH**/ ?>
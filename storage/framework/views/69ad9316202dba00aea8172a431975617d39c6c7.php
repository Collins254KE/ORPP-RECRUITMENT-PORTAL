

<?php $__env->startSection('content'); ?>
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg" style="max-width: 500px; width: 100%;">
        <div class="card-header bg-primary text-white text-center">
            <h4>Email Verification Required</h4>
        </div>
        <div class="card-body p-4">
            <?php if(session('message')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo e(session('message')); ?>

                </div>
            <?php endif; ?>

            <p class="text-center">
                Thanks for signing up! Before proceeding, please check your email for a verification link.
            </p>
            <p class="text-center">
                If you did not receive the email, we will gladly send you another.
            </p>

            <div class="d-grid gap-2">
                <form method="POST" action="<?php echo e(route('verification.send')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-primary w-100">
                        Resend Verification Email
                    </button>
                </form>
            </div>
        </div>
        
            <div class="text-center mt-3">
                <a href="<?php echo e(route('register')); ?>" class="text-decoration-none">
                    ← Back to Registration
                </a>
            </div>
        </div>
        <div class="card-footer text-center text-muted">
            <small>ORPP © <?php echo e(date('Y')); ?></small>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\orpp6\resources\views\auth\verify-email.blade.php ENDPATH**/ ?>
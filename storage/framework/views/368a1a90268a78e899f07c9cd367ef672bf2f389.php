

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Application Details</h1>

    <h3>Job Title: <?php echo e($application->jobListing->title); ?></h3>
    <p><strong>Location:</strong> <?php echo e($application->jobListing->location); ?></p>
    <p><strong>Status:</strong> <?php echo e($application->status); ?></p>
    <p><strong>Applied On:</strong> <?php echo e($application->created_at->format('d M Y')); ?></p>

    <?php if($application->document_filename): ?>
        <p>
            <a href="<?php echo e(route('application.viewDocument', $application->id)); ?>" target="_blank" class="btn btn-primary">
                View Document
            </a>
        </p>
    <?php else: ?>
        <p>No document uploaded.</p>
    <?php endif; ?>

    <a href="<?php echo e(route('user.applications')); ?>" class="btn btn-secondary">Back to Applications</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\orpp6\resources\views\user\application_detail.blade.php ENDPATH**/ ?>
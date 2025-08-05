

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1><?php echo e($job_detail->title); ?></h1>
    <p><strong>Code:</strong> <?php echo e($job_detail->code); ?></p>
    <p><strong>Location:</strong> <?php echo e($job_detail->location); ?></p>
    <p><strong>Deadline:</strong> 
  <?php echo e($job_detail->deadline ? $job_detail->deadline->format('d M Y') : 'Not specified'); ?>

</p>

    <p><strong>Description:</strong></p>
    <p><?php echo e($job_detail->description); ?></p>

    
    <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if($hasApplied): ?>
        <div class="alert alert-info">You have already applied for this job.</div>
    <?php else: ?>
        <a href="<?php echo e(route('applications.apply', $job_detail->id)); ?>" class="btn btn-primary">Apply for this Job</a>
    <?php endif; ?>

    <a href="<?php echo e(route('user.applications')); ?>" class="btn btn-secondary">Back to Applications</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\orpp6\resources\views\user\job_detail.blade.php ENDPATH**/ ?>
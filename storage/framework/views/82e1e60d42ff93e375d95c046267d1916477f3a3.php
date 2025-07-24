

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Job Applications</h1>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if($applications->count()): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($application->jobListing->title); ?></td>
                        <td><?php echo e($application->location); ?></td>
                        <td><?php echo e($application->status); ?></td>
                        <td><a href="<?php echo e(route('applications.show', $application->id)); ?>" class="btn btn-info">View</a></td>


                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <!-- Pagination Links -->
        <?php echo e($applications->links()); ?>

    <?php else: ?>
        <p>No applications found.</p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\orpp6\resources\views/user/my_applications.blade.php ENDPATH**/ ?>
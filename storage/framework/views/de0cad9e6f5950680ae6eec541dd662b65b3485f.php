

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>User Profile</h1>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link <?php echo e(request()->routeIs('profile') ? 'active' : ''); ?>" href="<?php echo e(route('profile')); ?>">Biodata</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link <?php echo e(request()->routeIs('academic_records.index') ? 'active' : ''); ?>" href="<?php echo e(route('academic_records.index')); ?>">Academic Records</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link <?php echo e(request()->routeIs('professional_qualifications.index') ? 'active' : ''); ?>" href="<?php echo e(route('professional_qualifications.index')); ?>">Professional Qualifications</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link <?php echo e(request()->routeIs('professional_memberships.index') ? 'active' : ''); ?>" href="<?php echo e(route('professional_memberships.index')); ?>">Professional Bodies</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link <?php echo e(request()->routeIs('employment_history.index') ? 'active' : ''); ?>" href="<?php echo e(route('employment_history.index')); ?>">Work Experience</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link <?php echo e(request()->routeIs('referees.index') ? 'active' : ''); ?>" href="<?php echo e(route('referees.index')); ?>">Referees</a>
        </li>
    </ul>

    <div class="card mb-4">
        <div class="card-body">
            <a href="<?php echo e(route('employment_history.create')); ?>" class="btn btn-primary mb-3">Add New</a>

            <?php if($employmentHistories->isEmpty()): ?>
                <p>No employment history found.</p>
            <?php else: ?>
                <table class="table" style="border: 2px solid #007bff;">
                    <thead>
                        <tr style="background-color: #e6f0ff;">
                            <th colspan="6" style="text-align: left; padding: 12px; border-bottom: 2px solid #007bff; color: #004085; font-size: 18px;">
                                Employment History
                            </th>
                        </tr>
                        <tr>
                            <th style="border-left: 1px solid #007bff;">Employer Name</th>
                            <th style="border-left: 1px solid #007bff;">Job Position</th>
                            <th style="border-left: 1px solid #007bff;">From</th>
                            <th style="border-left: 1px solid #007bff;">To</th>
                            <th style="border-left: 1px solid #007bff;">Roles & Responsibilities</th>
                            <th style="border-left: 1px solid #007bff;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $employmentHistories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td style="border-left: 1px solid #007bff;"><?php echo e($history->employer_name); ?></td>
                                <td style="border-left: 1px solid #007bff;"><?php echo e($history->job_position); ?></td>
                                <td style="border-left: 1px solid #007bff;">
                                    <?php echo e($history->date_joined ? \Carbon\Carbon::parse($history->date_joined)->format('d M Y') : 'N/A'); ?>

                                </td>
                                <td style="border-left: 1px solid #007bff;">
                                    <?php echo e($history->date_left ? \Carbon\Carbon::parse($history->date_left)->format('d M Y') : 'Current'); ?>

                                </td>
                                <td style="border-left: 1px solid #007bff;"><?php echo e(strip_tags($history->roles_responsibilities)); ?></td>
                                <td style="border-left: 1px solid #007bff;">
                                    <a href="<?php echo e(route('employment_history.edit', $history->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="<?php echo e(route('employment_history.destroy', $history->id)); ?>" method="POST" style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\orpp6\resources\views/user/employment_history/index.blade.php ENDPATH**/ ?>


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
            <a class="nav-link <?php echo e(request()->routeIs('professional_memberships.index') ? 'active' : ''); ?>" href="<?php echo e(route('professional_memberships.index')); ?>">Professional Membership</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link <?php echo e(request()->routeIs('employment_history.index') ? 'active' : ''); ?>" href="<?php echo e(route('employment_history.index')); ?>">Employment History</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link <?php echo e(request()->routeIs('referees.index') ? 'active' : ''); ?>" href="<?php echo e(route('referees.index')); ?>">Referees</a>
        </li>
    </ul>

    <div class="card mb-4">
        <div class="card-body">
            <a href="<?php echo e(route('professional_qualifications.create')); ?>" class="btn btn-primary mb-3">Add New</a>

            <?php if($qualifications->isEmpty()): ?>
                <p>No professional qualifications found.</p>
            <?php else: ?>
                <table class="table" style="border: 2px solid #007bff; margin-bottom: 20px;">
                    <thead>
                        <tr style="background-color: #e6f0ff;">
                            <th colspan="4" style="text-align: left; padding: 12px; border-bottom: 2px solid #007bff; color: #004085; font-size: 18px;">
                                Professional Qualifications
                            </th>
                        </tr>
                        <tr>
                            <th style="border-left: 1px solid #007bff;"><div>Level</div></th>
                            <th style="border-left: 1px solid #007bff;"><div>Description</div></th>
                            <th style="border-left: 1px solid #007bff;"><div>File</div></th>
                            <th style="border-left: 1px solid #007bff;"><div>Actions</div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $qualifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qualification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="border-left: 1px solid #007bff;"><?php echo e($qualification->levelDescription()); ?></td>
                            <td style="border-left: 1px solid #007bff;"><?php echo e($qualification->description); ?></td>
                            <td style="border-left: 1px solid #007bff;">
                                <a href="<?php echo e(route('files.professional_qualification.view', $qualification->id)); ?>" target="_blank" class="btn btn-info btn-sm">View</a>
                                <a href="<?php echo e(route('files.professional_qualification.download', $qualification->id)); ?>" class="btn btn-success btn-sm">Download</a>
                            </td>
                            <td style="border-left: 1px solid #007bff;">
                                <a href="<?php echo e(route('professional_qualifications.edit', $qualification->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                                <form action="<?php echo e(route('professional_qualifications.destroy', $qualification->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this qualification?')">Delete</button>
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

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\orpp6\resources\views\user\professional_qualifications\index.blade.php ENDPATH**/ ?>


<?php $__env->startSection('content'); ?>
    <h1>Applications</h1>



    <form action="<?php echo e(route('admin.applicants.filter')); ?>" method="GET" style="margin-bottom: 1rem;">
        <label for="min_qualification">Minimum Qualification:</label>
        <select name="min_qualification" id="min_qualification">
            <option value="" <?php echo e(request('min_qualification') == '' ? 'selected' : ''); ?>>Any</option>
            <option value="Certificate" <?php echo e(request('min_qualification') == 'Certificate' ? 'selected' : ''); ?>>Certificate</option>
            <option value="Diploma" <?php echo e(request('min_qualification') == 'Diploma' ? 'selected' : ''); ?>>Diploma</option>
            <option value="Degree" <?php echo e(request('min_qualification') == 'Degree' ? 'selected' : ''); ?>>Degree</option>
            <option value="Master" <?php echo e(request('min_qualification') == 'Master' ? 'selected' : ''); ?>>Master</option>
            <option value="PhD" <?php echo e(request('min_qualification') == 'PhD' ? 'selected' : ''); ?>>PhD</option>
        </select>

        <label for="min_experience_years">Minimum Years of Experience:</label>
        <input
            type="number"
            name="min_experience_years"
            id="min_experience_years"
            min="0"
            step="1"
            value="<?php echo e(request('min_experience_years')); ?>"
        />

        <button type="submit">Filter</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Job Title</th>
                <th>Applicant</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($application->jobListing->title ?? 'N/A'); ?>

</td>
                    
                    <td><?php echo e($application->user->name); ?></td>
                    <td><?php echo e($application->status); ?></td>
                    <td>
                        <a href="<?php echo e(route('admin.applications.show', $application->id)); ?>" class="btn btn-info">View</a>

                        <form action="<?php echo e(route('admin.applications.update', $application->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <select name="status" onchange="this.form.submit()">
                                <option value="Processing" <?php echo e($application->status == 'Processing' ? 'selected' : ''); ?>>Processing</option>
                                <option value="Interviews" <?php echo e($application->status == 'Interviews' ? 'selected' : ''); ?>>Interviews</option>
                                <option value="Shortlisted" <?php echo e($application->status == 'Shortlisted' ? 'selected' : ''); ?>>Shortlisted</option>
                                <option value="Closed" <?php echo e($application->status == 'Closed' ? 'selected' : ''); ?>>Closed</option>
                            </select>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\orpp6\resources\views/admin/applications/index.blade.php ENDPATH**/ ?>
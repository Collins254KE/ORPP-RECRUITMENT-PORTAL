

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Edit Employment History</h1>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <div class="card mb-4">
            <div class="card-body">
                <form action="<?php echo e(route('employment_history.update', $employmentHistory->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?> <!-- Specify the PUT method for updating -->

                    <div class="mb-3">
                        <label for="employer_name" class="form-label">Employer Name</label>
                        <input type="text" class="form-control" name="employer_name"
                            value="<?php echo e($employmentHistory->employer_name); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="job_position" class="form-label">Job Position Held</label>
                        <input type="text" class="form-control" name="job_position"
                            value="<?php echo e($employmentHistory->job_position); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="date_joined" class="form-label">From</label>
                        <input type="date" class="form-control" name="date_joined"
                          value="<?php echo e(\Carbon\Carbon::parse($employmentHistory->date_joined)->format('Y-m-d')); ?>" required>

                    </div>
                    <div class="mb-3">
                        <label for="date_left" class="form-label">To</label>
                        <input type="date" class="form-control" name="date_left"
value="<?php echo e($employmentHistory->date_left ? \Carbon\Carbon::parse($employmentHistory->date_left)->format('Y-m-d') : ''); ?>"
>
                    </div>
                    <div class="mb-3">
                        <label for="roles_responsibilities" class="form-label">Summary of Roles & Responsibilities (Max 250
                            Characters)</label>
                        <textarea class="form-control" name="roles_responsibilities" maxlength="250"
                            required><?php echo e($employmentHistory->roles_responsibilities); ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="<?php echo e(route('employment_history.index')); ?>" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\orpp6\resources\views\user\employment_history\edit.blade.php ENDPATH**/ ?>
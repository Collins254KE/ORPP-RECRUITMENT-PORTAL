

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Edit Referee</h1>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <div class="card mb-4">
            <div class="card-body">
                <form action="<?php echo e(route('referees.update', $referee->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?> <!-- Specify the PUT method for updating -->

                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="first_name" value="<?php echo e($referee->first_name); ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="middle_name" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" name="middle_name" value="<?php echo e($referee->middle_name); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="other_name" class="form-label">Other Name</label>
                        <input type="text" class="form-control" name="other_name" value="<?php echo e($referee->other_name); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="organization" class="form-label">Organization</label>
                        <input type="text" class="form-control" name="organization" value="<?php echo e($referee->organization); ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="designation" class="form-label">Designation</label>
                        <input type="text" class="form-control" name="designation" value="<?php echo e($referee->designation); ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="postal_address" class="form-label">Postal Address</label>
                        <input type="text" class="form-control" name="postal_address" value="<?php echo e($referee->postal_address); ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="postal_code" class="form-label">Postal Code</label>
                        <input type="text" class="form-control" name="postal_code" value="<?php echo e($referee->postal_code); ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="city_town" class="form-label">City/Town</label>
                        <input type="text" class="form-control" name="city_town" value="<?php echo e($referee->city_town); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="referee_type" class="form-label">Type of Referee</label>
                        <select class="form-control" name="referee_type" required>
                            <option value="professional" <?php echo e($referee->referee_type == 'professional' ? 'selected' : ''); ?>>
                                Professional</option>
                            <option value="personal" <?php echo e($referee->referee_type == 'personal' ? 'selected' : ''); ?>>Personal
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Professional Referee Email Address</label>
                        <input type="email" class="form-control" name="email" value="<?php echo e($referee->email); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="mobile_phone" class="form-label">Mobile Phone No.</label>
                        <input type="text" class="form-control" name="mobile_phone" value="<?php echo e($referee->mobile_phone); ?>"
                            required>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="<?php echo e(route('referees.index')); ?>" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\orpp6\resources\views\user\referees\edit.blade.php ENDPATH**/ ?>
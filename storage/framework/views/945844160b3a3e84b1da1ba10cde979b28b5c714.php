

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Edit Professional Membership</h1>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <div class="card mb-4">
            <div class="card-body">
                <form action="<?php echo e(route('professional_memberships.update', $membership->id)); ?>" method="POST"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?> <!-- Specify the PUT method for updating -->

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" required><?php echo e($membership->description); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Attach New PDF Document (optional)</label>
                        <input type="file" class="form-control" name="file" accept=".pdf">
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="<?php echo e(route('professional_memberships.index')); ?>" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\orpp6\resources\views\user\professional_memberships\edit.blade.php ENDPATH**/ ?>


<?php $__env->startSection('content'); ?>
    <h1>Edit Job Listing</h1>
    <form action="<?php echo e(route('admin.job-listings.update', $jobListing->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="<?php echo e($jobListing->title); ?>" required>
        </div>

        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" name="code" class="form-control" value="<?php echo e($jobListing->code); ?>" required>
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" class="form-control" value="<?php echo e($jobListing->location); ?>" required>
        </div>

        <div class="form-group">
            <label for="posts">Posts</label>
            <input type="number" name="posts" id="posts" class="form-control"
                value="<?php echo e(old('posts', $jobListing->posts ?? '')); ?>" min="1">
        </div>

        <div class="form-group">
            <label for="duties_and_responsibilities">Duties & Responsibilities</label>
            <textarea name="duties_and_responsibilities" class="form-control" rows="4" required><?php echo e($jobListing->duties_and_responsibilities); ?></textarea>
        </div>

        <div class="form-group">
            <label for="requirements">Requirements</label>
            <textarea name="requirements" class="form-control" rows="4" required><?php echo e($jobListing->requirements); ?></textarea>
        </div>

        <div class="form-group">
            <label for="deadline">Deadline</label>
            <input type="datetime-local" name="deadline" class="form-control"
                value="<?php echo e($jobListing->deadline ? $jobListing->deadline->format('Y-m-d\TH:i') : ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="min_years_of_experience">Minimum Years of Experience</label>
            <input type="number" id="min_years_of_experience" name="min_years_of_experience" class="form-control"
                min="0" max="50"
                value="<?php echo e(old('min_years_of_experience', $jobListing->min_years_of_experience ?? 0)); ?>">
        </div>

        <div class="form-group">
            <label for="min_level">Minimum Qualification Level</label>
            <select id="min_level" name="min_level" class="form-control">
                <option value="">No Minimum Requirement</option>
                <option value="1" <?php echo e(old('min_level', $jobListing->min_level) == '1' ? 'selected' : ''); ?>>Certificate
                </option>
                <option value="2" <?php echo e(old('min_level', $jobListing->min_level) == '2' ? 'selected' : ''); ?>>Diploma
                </option>
                <option value="3" <?php echo e(old('min_level', $jobListing->min_level) == '3' ? 'selected' : ''); ?>>Degree
                </option>
                <option value="4" <?php echo e(old('min_level', $jobListing->min_level) == '4' ? 'selected' : ''); ?>>Master
                </option>
                <option value="5" <?php echo e(old('min_level', $jobListing->min_level) == '5' ? 'selected' : ''); ?>>PhD</option>
            </select>
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="is_published" value="1"
                    <?php echo e(old('is_published', $jobListing->is_published ?? false) ? 'checked' : ''); ?>>
                Publish this job
            </label>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\orpp6\resources\views/admin/job-listings/edit.blade.php ENDPATH**/ ?>
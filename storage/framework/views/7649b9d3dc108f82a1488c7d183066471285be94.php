

<?php $__env->startSection('content'); ?>
    <h1>Create Job Listing</h1>

    <form action="<?php echo e(route('admin.job-listings.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="form-group">
            <label for="title">Job Title</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>
       

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" id="location" name="location" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="posts">Posts</label>
            <input type="number" name="posts" id="posts" class="form-control" value="<?php echo e(old('posts', $job->posts ?? '')); ?>" min="1">
        </div>
        <div class="form-group">
            <label for="duties_and_responsibilities">Duties & Responsibilities</label>
            <textarea id="duties_and_responsibilities" name="duties_and_responsibilities" class="form-control" rows="4"></textarea>
        </div>

        <div class="form-group">
            <label for="requirements">Requirements</label>
            <textarea id="requirements" name="requirements" class="form-control" rows="4"></textarea>
        </div>

        <div class="form-group">
            <label for="deadline">Application Deadline</label>
            <input type="datetime-local" id="deadline" name="deadline" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="min_years_of_experience">Minimum Years of Experience</label>
            <input type="number" id="min_years_of_experience" name="min_years_of_experience" class="form-control" min="0" max="50" value="<?php echo e(old('min_years_of_experience', 0)); ?>">
        </div>

        <div class="form-group">
            <label for="min_level">Minimum Qualification Level</label>
            <select id="min_level" name="min_level" class="form-control">
                <option value="">No Minimum Requirement</option>
                <option value="1" <?php echo e(old('min_level') == '1' ? 'selected' : ''); ?>>Certificate</option>
                <option value="2" <?php echo e(old('min_level') == '2' ? 'selected' : ''); ?>>Diploma</option>
                <option value="3" <?php echo e(old('min_level') == '3' ? 'selected' : ''); ?>>Degree</option>
                <option value="4" <?php echo e(old('min_level') == '4' ? 'selected' : ''); ?>>Master</option>
                <option value="5" <?php echo e(old('min_level') == '5' ? 'selected' : ''); ?>>PhD</option>
            </select>
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="is_published" value="1" <?php echo e(old('is_published') ? 'checked' : ''); ?>>
                Publish this job
            </label>
        </div>

        <button type="submit" class="btn btn-success">Create Job</button>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\orpp6\resources\views/admin/job-listings/create.blade.php ENDPATH**/ ?>
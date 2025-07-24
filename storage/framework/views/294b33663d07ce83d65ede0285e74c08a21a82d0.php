

<?php $__env->startSection('content'); ?>
    <h1 class="mb-4">Job Listings</h1>

    <!-- Filter Form -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Filter Job Listings</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="<?php echo e(route('admin.job-listings.index')); ?>" class="row g-3">
                <div class="col-md-3">
                    <label for="min_level" class="form-label">Minimum Qualification Level</label>
                    <select name="min_level" id="min_level" class="form-select">
                        <option value="">All Levels</option>
                        <option value="1" <?php echo e($filters['min_level'] == '1' ? 'selected' : ''); ?>>Certificate</option>
                        <option value="2" <?php echo e($filters['min_level'] == '2' ? 'selected' : ''); ?>>Diploma</option>
                        <option value="3" <?php echo e($filters['min_level'] == '3' ? 'selected' : ''); ?>>Degree</option>
                        <option value="4" <?php echo e($filters['min_level'] == '4' ? 'selected' : ''); ?>>Master</option>
                        <option value="5" <?php echo e($filters['min_level'] == '5' ? 'selected' : ''); ?>>PhD</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="min_years_of_experience" class="form-label">Min Years Experience</label>
                    <input type="number" name="min_years_of_experience" id="min_years_of_experience" 
                           class="form-control" min="0" max="50" 
                           value="<?php echo e($filters['min_years_of_experience'] ?? ''); ?>" 
                           placeholder="Any">
                </div>
                <div class="col-md-3">
                    <label for="is_published" class="form-label">Published Status</label>
                    <select name="is_published" id="is_published" class="form-select">
                        <option value="">All</option>
                        <option value="1" <?php echo e($filters['is_published'] == '1' ? 'selected' : ''); ?>>Published</option>
                        <option value="0" <?php echo e($filters['is_published'] == '0' ? 'selected' : ''); ?>>Draft</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="<?php echo e(route('admin.job-listings.index')); ?>" class="btn btn-secondary">Clear</a>
                    <a href="<?php echo e(route('admin.applications.analytics')); ?>" class="btn btn-info">Report</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Add New Button -->
    <div class="mb-3">
        <a href="<?php echo e(route('admin.job-listings.create')); ?>" class="btn btn-success">+ Add New Job Listing</a>
    </div>

    <!-- Job Listings Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
           <thead class="text-white text-center">
    <tr class="bg-primary">
        <th class="bg-primary">Title</th>
        <th class="bg-primary">Location</th>
        <th class="bg-primary">Deadline</th>
        <th class="bg-primary">Posts</th>
        <th class="bg-primary">Min Level</th>
        <th class="bg-primary">Min Experience</th>
        <th class="bg-primary">Applicants</th>
        <th class="bg-primary">Published</th>
        <th class="bg-primary">Actions</th>
    </tr>
</thead>

            <tbody>
                <?php $__currentLoopData = $jobListings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobListing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($jobListing->title); ?></td>
                        <td><?php echo e($jobListing->location); ?></td>
<td>
    <?php echo e(\Carbon\Carbon::parse($jobListing->deadline)->format('Y-m-d')); ?>

    <?php if(\Carbon\Carbon::parse($jobListing->deadline)->isPast()): ?>
        <span class="badge bg-danger ms-1">Expired</span>
    <?php else: ?>
        <span class="badge bg-success ms-1">Active</span>
    <?php endif; ?>
</td>
                        <td><?php echo e($jobListing->posts ?? '—'); ?></td>
                        <td>
                            <?php if($jobListing->min_level): ?>
                                <?php switch($jobListing->min_level):
                                    case (1): ?> Certificate <?php break; ?>
                                    <?php case (2): ?> Diploma <?php break; ?>
                                    <?php case (3): ?> Degree <?php break; ?>
                                    <?php case (4): ?> Master <?php break; ?>
                                    <?php case (5): ?> PhD <?php break; ?>
                                    <?php default: ?> Unknown
                                <?php endswitch; ?>
                            <?php else: ?>
                                <span class="text-muted">Any</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($jobListing->min_years_of_experience): ?>
                                <?php echo e($jobListing->min_years_of_experience); ?> years
                            <?php else: ?>
                                <span class="text-muted">Any</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($jobListing->applications?->count() ?? 0); ?></td>
                        <td><?php echo e($jobListing->is_published ? 'Yes' : 'No'); ?></td>
                      <td>
    <div class="d-flex justify-content-center align-items-center gap-1 flex-nowrap">
        <a href="<?php echo e(route('admin.job-listings.edit', $jobListing->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="<?php echo e(route('admin.applications.index', ['job_id' => $jobListing->id])); ?>" class="btn btn-info btn-sm">View</a>
        <a href="<?php echo e(route('admin.applications.export', ['job_id' => $jobListing->id])); ?>" class="btn btn-success btn-sm">Export</a>
        <form action="<?php echo e(route('admin.job-listings.destroy', $jobListing->id)); ?>" method="POST" onsubmit="return confirm('Delete this job listing?')" class="d-inline">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
        </form>
    </div>
</td>


                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\orpp6\resources\views/admin/job-listings/index.blade.php ENDPATH**/ ?>


<?php $__env->startSection('content'); ?>
    <div class="container small" style="font-size: 0.875rem;">
        <h1>Available Job Listings</h1>
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(!auth()->user()->is_staff): ?>
            <?php if(!auth()->user()->isProfileComplete()): ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <h5 class="alert-heading">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Complete Your Profile
                            </h5>
                            <p class="mb-2">Your profile is incomplete. Please complete all required information to apply
                                for jobs.</p>

                            <!-- Progress Bar -->
                            <div class="progress mb-3" style="height: 20px;">
                                <div class="progress-bar bg-warning" role="progressbar"
                                    style="width: <?php echo e(auth()->user()->profileCompleteness()); ?>%"
                                    aria-valuenow="<?php echo e(auth()->user()->profileCompleteness()); ?>" aria-valuemin="0"
                                    aria-valuemax="100">
                                    <?php echo e(auth()->user()->profileCompleteness()); ?>% Complete
                                </div>
                            </div>

                            <!-- Missing Items -->
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-muted">Missing Information:</h6>
                                    <ul class="list-unstyled small">
                                        <?php if(empty(auth()->user()->name)): ?>
                                            <li><i class="fas fa-times text-danger me-1"></i>Full Name</li>
                                        <?php endif; ?>
                                        <?php if(empty(auth()->user()->dob)): ?>
                                            <li><i class="fas fa-times text-danger me-1"></i>Date of Birth</li>
                                        <?php endif; ?>
                                        <?php if(empty(auth()->user()->phone)): ?>
                                            <li><i class="fas fa-times text-danger me-1"></i>Phone Number</li>
                                        <?php endif; ?>
                                        <?php if(empty(auth()->user()->county)): ?>
                                            <li><i class="fas fa-times text-danger me-1"></i>County</li>
                                        <?php endif; ?>
                                        <?php if(empty(auth()->user()->sub_county)): ?>
                                            <li><i class="fas fa-times text-danger me-1"></i>Sub County</li>
                                        <?php endif; ?>
                                        <?php if(empty(auth()->user()->id_passport)): ?>
                                            <li><i class="fas fa-times text-danger me-1"></i>ID/Passport Number</li>
                                        <?php endif; ?>
                                        <?php if(empty(auth()->user()->kra_pin)): ?>
                                            <li><i class="fas fa-times text-danger me-1"></i>KRA PIN</li>
                                        <?php endif; ?>
                                        <?php if(empty(auth()->user()->disability_status)): ?>
                                            <li><i class="fas fa-times text-danger me-1"></i>Disability Status</li>
                                        <?php endif; ?>
                                        <?php if(auth()->user()->disability_status === 'yes' && empty(auth()->user()->disability_certificate_number)): ?>
                                            <li><i class="fas fa-times text-danger me-1"></i>Disability Certificate Number
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted">Missing Records:</h6>
                                    <ul class="list-unstyled small">
                                        <?php if(auth()->user()->academicRecords->isEmpty()): ?>
                                            <li><i class="fas fa-times text-danger me-1"></i>Academic Records</li>
                                        <?php endif; ?>
                                        <?php if(auth()->user()->professionalQualifications->isEmpty()): ?>
                                            <li><i class="fas fa-times text-danger me-1"></i>Professional Qualifications
                                            </li>
                                        <?php endif; ?>
                                        <?php if(auth()->user()->employmentHistory->isEmpty()): ?>
                                            <li><i class="fas fa-times text-danger me-1"></i>Employment History</li>
                                        <?php endif; ?>
                                        <?php if(auth()->user()->referees->isEmpty()): ?>
                                            <li><i class="fas fa-times text-danger me-1"></i>Referees</li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>

                            <a href="/profile" class="btn btn-warning">
                                <i class="fas fa-edit me-1"></i>Complete Profile Now
                            </a>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-check-circle me-2"></i>
                            <strong>Great!</strong> Your profile is complete and you can apply for jobs.
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <?php if($jobListings->count()): ?>
           <table class="table table-bordered border-dark">
    <thead style="background-color: #0033; color: white;" class="text-center">
        <tr>
            <th style="background-color: #0033;">Title</th>
            <th style="background-color: #0033;">Posts</th>
            <th style="background-color: #0033;">Job Description</th>
            <th style="background-color: #0033;">Location</th>
            <th style="background-color: #0033;">Status</th>
            <th style="background-color: #0033;">Actions</th>
        </tr>
    </thead>


                <tbody>
                    <?php $__currentLoopData = $jobListings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($job->title); ?></td>
                            <td><?php echo e($job->posts ?? 'N/A'); ?></td>
                            <td>
                                <button type="button" class="btn btn-link p-0" data-bs-toggle="modal"
                                    data-bs-target="#jobModal<?php echo e($job->id); ?>">
                                    View Job Description
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="jobModal<?php echo e($job->id); ?>" tabindex="-1"
                                    aria-labelledby="jobModalLabel<?php echo e($job->id); ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <div>
                                                    <h5 class="modal-title mb-0" id="jobModalLabel<?php echo e($job->id); ?>">
                                                        <strong><?php echo e($job->title); ?></strong>
                                                    </h5>
                                                    <small>REF NO: <span
                                                            class="text-warning fw-bold"><?php echo e($job->code); ?></span></small>
                                                </div>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="card border-primary">
                                                            <div class="card-header bg-light">
                                                                <h6 class="mb-0"><i
                                                                        class="fas fa-map-marker-alt text-primary"></i>
                                                                    Location</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                <p class="mb-0"><?php echo e($job->location); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="card border-warning">
                                                            <div class="card-header bg-light">
                                                                <h6 class="mb-0"><i
                                                                        class="fas fa-calendar-alt text-warning"></i>
                                                                    Application Deadline</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                <p class="mb-0">
                                                                    <?php echo e($job->deadline ? \Carbon\Carbon::parse($job->deadline)->format('d M Y') : 'Not specified'); ?>

                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php if($job->duties_and_responsibilities): ?>
                                                    <div class="card mb-3 border-info">
                                                        <div class="card-header bg-info text-white">
                                                            <h6 class="mb-0"><i class="fas fa-tasks"></i> Duties and
                                                                Responsibilities</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <?php echo nl2br(e($job->duties_and_responsibilities)); ?>

                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if(
                                                    $job->requirements ||
                                                        $job->min_experience ||
                                                        $job->min_qualification ||
                                                        $job->min_level ||
                                                        $job->min_years_of_experience): ?>
                                                    <div class="table-responsive mb-3">

                                                        <table class="table table-bordered border-success">
                                                            <thead>
                                                                <tr class="bg-info text-white">
                                                                    <th colspan="2">
                                                                        <i class="fas fa-graduation-cap me-1"></i>
                                                                        Requirements
                                                                    </th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                
                                                                <?php if($job->min_qualification): ?>
                                                                    <tr>
                                                                        <th style="width: 35%;">Minimum Qualification</th>
                                                                        <td><?php echo e($job->min_qualification); ?></td>
                                                                    </tr>
                                                                <?php endif; ?>

                                                                
                                                                <?php if($job->min_experience): ?>
                                                                    <tr>
                                                                        <th>Minimum Years of Experience</th>
                                                                        <td><?php echo e($job->min_experience); ?>

                                                                            year<?php echo e($job->min_experience > 1 ? 's' : ''); ?>

                                                                        </td>
                                                                    </tr>
                                                                <?php endif; ?>

                                                                
                                                                <?php if($job->requirements): ?>
                                                                    <tr>
                                                                        <th>Requirements</th>
                                                                        <td><?php echo nl2br(e($job->requirements)); ?></td>
                                                                    </tr>
                                                                <?php endif; ?>

                                                                
                                                                <?php if($job->min_level): ?>
                                                                    <tr>
                                                                        <th>Minimum Qualification Level</th>
                                                                        <td>
                                                                            <span class="badge bg-warning text-dark">
                                                                                <?php switch($job->min_level):
                                                                                    case (1): ?>
                                                                                        Certificate
                                                                                    <?php break; ?>

                                                                                    <?php case (2): ?>
                                                                                        Diploma
                                                                                    <?php break; ?>

                                                                                    <?php case (3): ?>
                                                                                        Degree
                                                                                    <?php break; ?>

                                                                                    <?php case (4): ?>
                                                                                        Masters
                                                                                    <?php break; ?>

                                                                                    <?php case (5): ?>
                                                                                        PhD
                                                                                    <?php break; ?>

                                                                                    <?php default: ?>
                                                                                        Unknown
                                                                                <?php endswitch; ?>
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                <?php endif; ?>

                                                                
                                                                <?php if($job->min_years_of_experience): ?>
                                                                    <tr>
                                                                        <th>Min Years of Experience</th>
                                                                        <td>
                                                                            <span class="badge bg-info text-dark">
                                                                                <?php echo e($job->min_years_of_experience); ?>

                                                                                year<?php echo e($job->min_years_of_experience > 1 ? 's' : ''); ?>

                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php endif; ?>




                                                <div class="modal-footer small">
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <?php if(!in_array($job->id, $userApplications)): ?>
                                                        <?php
                                                            $requirements = auth()->user()->meetsJobRequirements($job);
                                                        ?>

                                                        <?php if($requirements['eligible']): ?>
<?php
    $isExpired = $job->deadline && \Carbon\Carbon::parse($job->deadline)->isPast();
?>

<?php if($isExpired): ?>
    <div class="alert alert-danger mb-2">
        <i class="fas fa-exclamation-circle me-1"></i>
        This job is no longer open for application.
    </div>

    <a href="javascript:void(0);"
       class="btn btn-danger btn-sm"
       onclick="alert('Application closed for this job.')">
        <i class="fas fa-times-circle me-1"></i> Apply Now
    </a>
<?php else: ?>
    <a href="<?php echo e(route('applications.apply', $job->id)); ?>"
       class="btn btn-primary btn-sm">
        <i class="fas fa-paper-plane me-1"></i> Apply Now
    </a>
<?php endif; ?>


                                                        <?php else: ?>
                                                            <div class="text-center text-muted small">
                                                                <i class="fas fa-ban text-danger mb-1"
                                                                    style="font-size: 1em;"></i>
                                                                <div class="small">
                                                                    <?php $__currentLoopData = $requirements['reasons']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <div><?php echo e($reason); ?></div>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </div>
                                                                <?php if(in_array('Profile is incomplete', $requirements['reasons'])): ?>
                                                                    <a href="/profile"
                                                                        class="btn btn-warning btn-sm mt-1">
                                                                        <i class="fas fa-edit me-1"></i>Complete Profile
                                                                    </a>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <a href="<?php echo e(route('applications.show', $job->id)); ?>"
                                                            class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye me-1"></i>View Application
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                            </td>
                            <td><?php echo e($job->location); ?></td>
                            <td>
                                <?php if(in_array($job->id, $userApplications)): ?>
                                    <span class="badge bg-success">Applied</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Not Applied</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                    $requirements = auth()->user()->meetsJobRequirements($job);
                                ?>

                                <?php if(!in_array($job->id, $userApplications)): ?>
                                    <?php if($requirements['eligible']): ?>
                                        <a href="<?php echo e(route('applications.apply', $job->id)); ?>" class="btn btn-primary">
                                            <i class="fas fa-paper-plane me-1"></i>Apply
                                        </a>
                                    <?php else: ?>
                                        <div class="text-center">
                                            <i class="fas fa-ban text-danger mb-1" style="font-size: 1.2em;"></i>
                                            <div class="small text-muted">
                                                <?php $__currentLoopData = $requirements['reasons']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div><?php echo e($reason); ?></div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <?php if(in_array('Profile is incomplete', $requirements['reasons'])): ?>
                                                <a href="/profile" class="btn btn-warning btn-sm mt-1">
                                                    <i class="fas fa-edit me-1"></i>Complete Profile
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <a href="<?php echo e(route('applications.show', $job->id)); ?>" class="btn btn-info">
                                        <i class="fas fa-eye me-1"></i>View Application
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No job listings available.</p>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\orpp6\resources\views/user/applications.blade.php ENDPATH**/ ?>
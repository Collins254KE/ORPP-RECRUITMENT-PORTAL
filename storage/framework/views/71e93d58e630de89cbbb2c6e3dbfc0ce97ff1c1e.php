

<?php $__env->startSection('content'); ?>
<h1>Application Details</h1>
<h2>Job Title: <?php echo e(optional($application->jobListing)->title ?: 'N/A'); ?></h2>


<h3>Applicant: <?php echo e($application->user->name); ?></h3>
<?php if(auth()->user()->is_staff): ?>
<p>
<form action="<?php echo e(route('admin.applications.update', $application->id)); ?>" method="POST" style="display:inline;">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    Status:
    <select name="status" onchange="this.form.submit()">
        <option value="Processing" <?php echo e($application->status == 'Processing' ? 'selected' : ''); ?>>Processing</option>
        <option value="Interviews" <?php echo e($application->status == 'Interviews' ? 'selected' : ''); ?>>Interviews</option>
        <option value="Shortlisted" <?php echo e($application->status == 'Shortlisted' ? 'selected' : ''); ?>>Shortlisted</option>
        <option value="Closed" <?php echo e($application->status == 'Closed' ? 'selected' : ''); ?>>Closed</option>
    </select>
</form>
</p>
<p>Updated By: <?php echo e(optional($application->updatedBy)->name ?? 'N/A'); ?></p>
<?php endif; ?>

<p>Application Date: <?php echo e($application->created_at->format('Y-m-d H:i')); ?></p>
<h6>Candidate Profile</h6>
<div class="card mb-4">
    <div class="card-body">
        <p><strong>Name:</strong> <?php echo e($application->user->name); ?></p>
        <p><strong>Title:</strong> <?php echo e($application->user->title); ?></p>
        <p><strong>Email:</strong> <?php echo e($application->user->email); ?></p>
        <p><strong>Phone:</strong> <?php echo e($application->user->phone); ?></p>
        <p><strong>ID/Passport:</strong> <?php echo e($application->user->id_passport); ?></p>
        <p><strong>KRA PIN:</strong> <?php echo e($application->user->kra_pin); ?></p>
        <p><strong>County:</strong> <?php echo e($application->user->county); ?></p>
        <p><strong>Sub-County:</strong> <?php echo e($application->user->sub_county); ?></p>
        <p><strong>Ethnicity:</strong> <?php echo e($application->user->ethnicity); ?></p>
        <p><strong>Gender:</strong> <?php echo e($application->user->gender); ?></p>
        <p><strong>Nationality:</strong> <?php echo e($application->user->nationality); ?></p>
        <p><strong>Date of Birth:</strong> <?php echo e(\Carbon\Carbon::parse($application->user->dob)->format('F d, Y')); ?></p>

    </div>
</div>
<!-- add profile academic information -->
<h6>Academic Qualifications</h6>
<div class="card mb-4">
    <div class="card-body">
        <?php if($application->user->academicRecords->isEmpty()): ?>
        <p>No academic records found.</p>
        <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Qualification </th>
                    <th>Course Name</th>
                    <th>Graduation Date</th>
                    <th>Institution Name</th>
                    <th>File</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $application->user->academicRecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($record->qualification_code); ?></td>
                    <td><?php echo e($record->qualification_name); ?></td>
                    <td>
                        <?php echo e($record->graduation_date ? \Carbon\Carbon::parse($record->graduation_date)->format('d M Y') : 'N/A'); ?>

                    </td>

                    <td><?php echo e($record->institution_name); ?></td>
                    <td><a href="<?php echo e(route('files.academic_record.view', $record->id)); ?>" target="_blank">View Document</a></td>
                    <td>
                        <a href="<?php echo e(route('academic_records.edit', $record->id)); ?>"
                            class="btn btn-warning btn-sm">Edit</a>
                        <form action="<?php echo e(route('academic_records.destroy', $record->id)); ?>" method="POST"
                            style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this record?');">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>
<!-- add profile work experience information -->
<h6>Employment History</h6>
<div class="card mb-4">
    <div class="card-body">

        <?php if($application->user->employmentHistory->isEmpty()): ?>
        <p>No employment history found.</p>
        <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Employer Name</th>
                    <th>Job Position</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Roles & Responsibilities</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $application->user->employmentHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($history->employer_name); ?></td>
                    <td><?php echo e($history->job_position); ?></td>
                    <td><?php echo e($history->date_joined ? \Carbon\Carbon::parse($history->date_joined)->format('d M Y') : 'N/A'); ?></td>
                    <td><?php echo e($history->date_left ? \Carbon\Carbon::parse($history->date_left)->format('d M Y') : 'Current'); ?></td>
                    <td><?php echo e(strip_tags($history->roles_responsibilities)); ?></td>

                    <td>
                        <a href="<?php echo e(route('employment_history.edit', $history->id)); ?>"
                            class="btn btn-warning btn-sm">Edit</a>
                        <form action="<?php echo e(route('employment_history.destroy', $history->id)); ?>" method="POST"
                            style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this record?');">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>
<!-- memberships -->
<h6>Professional Memberships</h6>
<div class="card mb-4">
    <div class="card-body">
        <?php if($application->user->professionalMemberships->isEmpty()): ?>
        <p>No professional membership found.</p>
        <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $application->user->professionalMemberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($membership->description ?? 'N/A'); ?></td>
                    <td>
                        <?php if($membership->file_path): ?>
                        <a href="<?php echo e(route('files.professional_membership.view', $membership->id)); ?>" target="_blank">View Document</a>
                        <?php else: ?>
                        N/A
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>
<!-- qualifications -->
<h6>Professional Qualifications</h6>
<div class="card mb-4">
    <div class="card-body">

        <?php if($application->user->professionalQualifications->isEmpty()): ?>
        <p>No professional qualifications found.</p>
        <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Level</th>
                    <th>Description</th>
                    <th>File</th>
                </tr>
            </thead>
            


            <tbody>
                <?php $__currentLoopData = $application->user->professionalQualifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qualification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($qualification->level); ?></td>
                    <td><?php echo e($qualification->description); ?></td>
                    <td>
                        <a href="<?php echo e(route('files.professional_qualification.view', $qualification->id)); ?>" target="_blank">View Document</a>
                    </td>

                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>


        </table>
        <?php endif; ?>
    </div>
</div>
<!-- add profile referees information -->
<h6>Referees</h6>
<div class="card mb-4">
    <div class="card-body">
        <?php if($application->user->referees->isEmpty()): ?>
        <p>No referees found.</p>
        <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Other Name</th>
                    <th>Organization</th>
                    <th>Designation</th>
                    <th>Referee Type</th>
                    <th>Email</th>
                    <th>Mobile Phone</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $application->user->referees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($referee->first_name); ?></td>
                    <td><?php echo e($referee->middle_name); ?></td>
                    <td><?php echo e($referee->other_name); ?></td>
                    <td><?php echo e($referee->organization); ?></td>
                    <td><?php echo e($referee->designation); ?></td>
                    <td><?php echo e(ucfirst($referee->referee_type)); ?></td>
                    <td><?php echo e($referee->professional_referee_email); ?></td>
                    <td><?php echo e($referee->mobile_phone); ?></td>

                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>
<?php if(auth()->user()->is_staff): ?>
<a href="<?php echo e(route('admin.applications.index')); ?>" class="btn btn-secondary">Back to Applications</a>
<?php else: ?>
<a href="<?php echo e(route('user.applications')); ?>" class="btn btn-secondary">Back to Applications</a>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\orpp6\resources\views/admin/applications/show.blade.php ENDPATH**/ ?>
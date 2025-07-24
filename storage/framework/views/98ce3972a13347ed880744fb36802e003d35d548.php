

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>User Profile</h1>
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link <?php echo e(request()->routeIs('profile')?'active': ''); ?>" id="biodata-tab" href="<?php echo e(route('profile')); ?>" role="tab">Biodata</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link <?php echo e(request()->routeIs('academic_records.index')?'active': ''); ?>" id="academic-tab" href="<?php echo e(route('academic_records.index')); ?>" role="tab">Academic
                    Records</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link <?php echo e(request()->routeIs('professional_qualifications.index')?'active': ''); ?>" id="qualifications-tab" href="<?php echo e(route('professional_qualifications.index')); ?>"
                    role="tab">Professional Qualifications</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link <?php echo e(request()->routeIs('professional_memberships.index')?'active': ''); ?>" id="bodies-tab" href="<?php echo e(route('professional_memberships.index')); ?>"
                    role="tab">Professional Bodies</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link <?php echo e(request()->routeIs('employment_history.index')?'active': ''); ?>" id="employment-tab" href="<?php echo e(route('employment_history.index')); ?>" role="tab">Employment
                    History</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link <?php echo e(request()->routeIs('referees.index')?'active': ''); ?>" id="referees-tab" href="<?php echo e(route('referees.index')); ?>" role="tab">Referees</a>
            </li>
        </ul>
        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Name:</strong> <?php echo e($user->name); ?></p>
                <p><strong>Title:</strong> <?php echo e($user->title); ?></p>
                <p><strong>Email:</strong> <?php echo e($user->email); ?></p>
                <p><strong>Phone:</strong> <?php echo e($user->phone); ?></p>
                <p><strong>ID/Passport:</strong> <?php echo e($user->id_passport); ?></p>
                <p><strong>KRA PIN:</strong> <?php echo e($user->kra_pin); ?></p>
                <p><strong>County:</strong> <?php echo e($user->county); ?></p>
    <p><strong>Sub-County:</strong> <?php echo e($user->sub_county); ?></p>
     <p><strong>Ward:</strong> <?php echo e($user->ward); ?></p>
    <p><strong>Ethnicity:</strong> <?php echo e($user->ethnicity); ?></p>
                <p><strong>Gender:</strong> <?php echo e($user->gender); ?></p>
                <p><strong>Nationality:</strong> <?php echo e($user->nationality); ?></p>
                <p><strong>Disability Certificate Number:</strong> <?php echo e($user->disability_certificate_number); ?></p>

    <p><strong>Date of Birth:</strong> <?php echo e(\Carbon\Carbon::parse($user->dob)->format('F d, Y')); ?></p>

<a href="<?php echo e(route('profile.edit')); ?>" class="btn btn-primary mt-3">Update biodata</a>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\orpp6\resources\views/user/profile.blade.php ENDPATH**/ ?>
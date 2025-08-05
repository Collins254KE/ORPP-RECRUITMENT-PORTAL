<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Applicant Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            line-height: 1.6;
            color: #333;
        }
        h1, h2 {
            text-align: center;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        table, th, td {
            border: 1px solid #555;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .section {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <h1>Applicant Summary Report</h1>
    <h2><?php echo e(now()->format('F j, Y')); ?></h2>

    <div class="section">
        <strong>Total Applicants:</strong> <?php echo e($totalApplicants); ?>

    </div>

    <div class="section">
        <h3>Gender Distribution</h3>
        <table>
            <thead>
                <tr>
                    <th>Gender</th>
                    <th>Count</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $genderStats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gender => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(ucfirst($gender)); ?></td>
                        <td><?php echo e($count); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <div class="section">
        <h3>Most Applied Job</h3>
        <p><strong><?php echo e($topJobTitle); ?></strong> — <?php echo e($topJobCount); ?> applicants</p>
    </div>

    <div class="section">
        <h3>Age Group Distribution</h3>
        <table>
            <thead>
                <tr>
                    <th>Age Group</th>
                    <th>Applicants</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $ageGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($group); ?></td>
                        <td><?php echo e($count); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <p><strong>Top Age Group:</strong> <?php echo e($topAgeGroup); ?> (<?php echo e($topAgePercent); ?>%)</p>
    </div>
</body>
</html>
<?php /**PATH C:\orpp6\resources\views\admin\applications\report-pdf.blade.php ENDPATH**/ ?>
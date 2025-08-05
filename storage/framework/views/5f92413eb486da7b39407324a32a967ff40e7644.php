

<?php $__env->startSection('title', 'Application Analytics'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h2 class="mb-4">Application Analytics Dashboard</h2>

    
    <div class="row mb-4">
        
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Gender Distribution</h5>
                    <?php if($genderDistribution->isNotEmpty()): ?>
                        <canvas id="genderChart" aria-label="Gender Distribution Chart" role="img"></canvas>
                    <?php else: ?>
                        <p class="text-muted">No gender data available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

<div class="col-md-6 mb-3">
    <div class="card shadow-sm h-100">
        <div class="card-body">
            <h5 class="card-title">Age Group Distribution</h5>
            <?php if($ageGroupDistribution->isNotEmpty()): ?>
                <canvas id="ageGroupChart" aria-label="Age Group Distribution Chart" role="img"></canvas>
            <?php else: ?>
                <p class="text-muted">No age group data available.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

        
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Regional Distribution (Counties)</h5>
                    <?php if($regionalDistribution->isNotEmpty()): ?>
                        <canvas id="regionChart" aria-label="Regional Distribution Chart" role="img"></canvas>
                    <?php else: ?>
                        <p class="text-muted">No regional data available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Application Trends (Last 30 Days)</h5>
            <?php if($applicationTrends->isNotEmpty()): ?>
                <canvas id="trendChart" aria-label="Application Trends Chart" role="img"></canvas>
            <?php else: ?>
                <p class="text-muted">No application trend data available.</p>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Applications per Job</h5>
            <?php if($applicationsPerJob->isNotEmpty()): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Job Title</th>
                                <th>Applications</th>
                                <th>Deadline</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $applicationsPerJob; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($job->title); ?></td>
                                    <td><?php echo e($job->applications_count); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($job->deadline)->format('M d, Y')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-muted">No job applications found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    <?php if($genderDistribution->isNotEmpty()): ?>
    new Chart(document.getElementById('genderChart'), {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($genderDistribution->pluck('gender')); ?>,
            datasets: [{
                data: <?php echo json_encode($genderDistribution->pluck('total')); ?>,
                backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56', '#4BC0C0'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
    <?php endif; ?>

    <?php if($regionalDistribution->isNotEmpty()): ?>
    new Chart(document.getElementById('regionChart'), {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($regionalDistribution->pluck('county')); ?>,
            datasets: [{
                label: 'Applicants',
                data: <?php echo json_encode($regionalDistribution->pluck('total')); ?>,
                backgroundColor: '#4BC0C0'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: {
                    ticks: {
                        autoSkip: false,
                        maxRotation: 90,
                        minRotation: 45
                    }
                }
            }
        }
    });
    <?php endif; ?>

    <?php if($applicationTrends->isNotEmpty()): ?>
    new Chart(document.getElementById('trendChart'), {
        type: 'line',
        data: {
            labels: <?php echo json_encode($applicationTrends->pluck('date')); ?>,
            datasets: [{
                label: 'Applications',
                data: <?php echo json_encode($applicationTrends->pluck('total')); ?>,
                borderColor: '#36A2EB',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true }
            },
            scales: {
                x: {
                    title: { display: true, text: 'Date' }
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    <?php endif; ?>
    <?php if($ageGroupDistribution->isNotEmpty()): ?>
new Chart(document.getElementById('ageGroupChart'), {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($ageGroupDistribution->pluck('age_group')); ?>,
        datasets: [{
            label: 'Applicants',
            data: <?php echo json_encode($ageGroupDistribution->pluck('total')); ?>,
            backgroundColor: '#FF9F40'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
<?php endif; ?>

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\orpp6\resources\views\admin\dashboard.blade.php ENDPATH**/ ?>
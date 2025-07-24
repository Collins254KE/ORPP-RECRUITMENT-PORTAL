@extends('admin.layouts.app')

@section('title', 'Application Analytics')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Application Analytics Dashboard</h2>

    {{-- Charts Section --}}
    <div class="row mb-4">
        {{-- Gender Distribution --}}
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Gender Distribution</h5>
                    @if ($genderDistribution->isNotEmpty())
                        <canvas id="genderChart" aria-label="Gender Distribution Chart" role="img"></canvas>
                    @else
                        <p class="text-muted">No gender data available.</p>
                    @endif
                </div>
            </div>
        </div>
{{-- Age Group Distribution --}}
<div class="col-md-6 mb-3">
    <div class="card shadow-sm h-100">
        <div class="card-body">
            <h5 class="card-title">Age Group Distribution</h5>
            @if ($ageGroupDistribution->isNotEmpty())
                <canvas id="ageGroupChart" aria-label="Age Group Distribution Chart" role="img"></canvas>
            @else
                <p class="text-muted">No age group data available.</p>
            @endif
        </div>
    </div>
</div>

        {{-- Regional Distribution --}}
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Regional Distribution (Counties)</h5>
                    @if ($regionalDistribution->isNotEmpty())
                        <canvas id="regionChart" aria-label="Regional Distribution Chart" role="img"></canvas>
                    @else
                        <p class="text-muted">No regional data available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Application Trends --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Application Trends (Last 30 Days)</h5>
            @if ($applicationTrends->isNotEmpty())
                <canvas id="trendChart" aria-label="Application Trends Chart" role="img"></canvas>
            @else
                <p class="text-muted">No application trend data available.</p>
            @endif
        </div>
    </div>

    {{-- Applications Per Job --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Applications per Job</h5>
            @if ($applicationsPerJob->isNotEmpty())
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
                            @foreach ($applicationsPerJob as $job)
                                <tr>
                                    <td>{{ $job->title }}</td>
                                    <td>{{ $job->applications_count }}</td>
                                    <td>{{ \Carbon\Carbon::parse($job->deadline)->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">No job applications found.</p>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    @if ($genderDistribution->isNotEmpty())
    new Chart(document.getElementById('genderChart'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($genderDistribution->pluck('gender')) !!},
            datasets: [{
                data: {!! json_encode($genderDistribution->pluck('total')) !!},
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
    @endif

    @if ($regionalDistribution->isNotEmpty())
    new Chart(document.getElementById('regionChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($regionalDistribution->pluck('county')) !!},
            datasets: [{
                label: 'Applicants',
                data: {!! json_encode($regionalDistribution->pluck('total')) !!},
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
    @endif

    @if ($applicationTrends->isNotEmpty())
    new Chart(document.getElementById('trendChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($applicationTrends->pluck('date')) !!},
            datasets: [{
                label: 'Applications',
                data: {!! json_encode($applicationTrends->pluck('total')) !!},
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
    @endif
    @if ($ageGroupDistribution->isNotEmpty())
new Chart(document.getElementById('ageGroupChart'), {
    type: 'bar',
    data: {
        labels: {!! json_encode($ageGroupDistribution->pluck('age_group')) !!},
        datasets: [{
            label: 'Applicants',
            data: {!! json_encode($ageGroupDistribution->pluck('total')) !!},
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
@endif

</script>
@endsection

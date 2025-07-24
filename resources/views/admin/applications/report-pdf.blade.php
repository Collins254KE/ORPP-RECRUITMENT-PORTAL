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
    <h2>{{ now()->format('F j, Y') }}</h2>

    <div class="section">
        <strong>Total Applicants:</strong> {{ $totalApplicants }}
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
                @foreach ($genderStats as $gender => $count)
                    <tr>
                        <td>{{ ucfirst($gender) }}</td>
                        <td>{{ $count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h3>Most Applied Job</h3>
        <p><strong>{{ $topJobTitle }}</strong> — {{ $topJobCount }} applicants</p>
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
                @foreach ($ageGroups as $group => $count)
                    <tr>
                        <td>{{ $group }}</td>
                        <td>{{ $count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p><strong>Top Age Group:</strong> {{ $topAgeGroup }} ({{ $topAgePercent }}%)</p>
    </div>
</body>
</html>

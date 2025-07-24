@extends('layout.main')

@section('content')
<h1>Applicant Summary Report</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Qualification Level</th>
            <th>Gender</th>
            <th>Age Group</th>
            <th>Total Applicants</th>
        </tr>
    </thead>
    <tbody>
        @forelse($summary as $row)
            <tr>
                <td>
                    @switch($row->qualification_level)
                        @case(1) Certificate @break
                        @case(2) Diploma @break
                        @case(3) Degree @break
                        @case(4) Master @break
                        @case(5) PhD @break
                        @default Unknown
                    @endswitch
                </td>
                <td>{{ ucfirst($row->gender) }}</td>
                <td>{{ $row->age_group }} yrs</td>
                <td>{{ $row->total }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No data found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
